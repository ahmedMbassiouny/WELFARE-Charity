<?php
require_once("../../Controller/DBController.php");
require_once('../../Model/donation.php');

$w = new donation;
class donationcontroller
{

  protected $db;


  function donate(donation $obj)
  {
    $this->db = new DBController();
    if ($this->db) {
      session_start();
      $sql = "INSERT INTO donation (user_id,sec_name, email, address, phone, payment_plan_id, amount,proj_id,pay_meth_id,org_id) VALUES ('{$obj->getUser_id()}','{$obj->getName()}','{$obj->getEmail()}','{$obj->getAddress()}','{$obj->getPhone()}','{$obj->getPaymentplan()}','{$obj->getAmount()}','{$obj->getProject_id()}','{$obj->getPaymentmethod()}','{$obj->getOrgId()}')";
      $result = $this->db->insert($sql);
      if ($result) {
        $tran_id =  $this->db->getLastId();
        // handle visa and vcash tables 
        if ($_SESSION['state'] == 1) {
          $query = "INSERT INTO vcash (tran_id,phoneNo) values ('$tran_id','{$_SESSION["phonenumber"]}')";
          $res = $this->db->insert($query);
          if (!$res) {
            echo "error in query";
          }
        } else if ($_SESSION['state'] == 2) {

          $query = "INSERT INTO visa (tran_id,VisaOwner,CardNo,ExpYear,ExpMonth,cvv) values ('$tran_id','{$_SESSION["cardowner"]}','{$_SESSION["cardNumber"]}','{$_SESSION["exp_year"]}','{$_SESSION["exp_month"]}','{$_SESSION["cvv"]}')";
          $res = $this->db->insert($query);
          if (!$res) {
            echo "error in query";
          }
        }


        //  handle donor table 
        $ws = $this->db->search_id('user_id', 'donor', $_SESSION['userId']);
        // if exist we will update values 
        if ($ws) {
          $sql  = "Select donations_num,total_amount,points from donor where user_id ={$_SESSION['userId']}  ";

          $data = $this->db->select($sql);
          $total_donation = $data[0]['donations_num'];
          $total_donation += 1;
          $total_amount = $data[0]['total_amount'];
          $total_amount += $_SESSION['amount'];
          $bonus = 0.1 * $_SESSION['amount'];
          $bonus += $data[0]['points'];
          $query = "UPDATE donor   SET points=$bonus , total_amount = $total_amount , donations_num = $total_donation  WHERE user_id={$_SESSION['userId']} ";
          $this->db->update($query);
        } else {
          // we will insert and update 
          $sql = "INSERT INTO donor (user_id) values ({$_SESSION['userId']})";
          $this->db->insert($sql);
          $bonus = 0.1 * $_SESSION['amount'];
          $query = "UPDATE donor   SET points=$bonus , total_amount = {$_SESSION['amount']} , donations_num = 1  WHERE user_id={$_SESSION['userId']} ";
          $this->db->update($query);
        }
      } else {
        echo "error in query";
      }
      $this->db->closeConnection();
    }
  }
}





?>
