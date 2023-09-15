<?php

require_once "../../Model/feedback.php";
require_once "../../Controller/DBController.php";

class feedbackController extends feedback{
    protected $conn;



    public function giveFeedback($email,$msg){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="insert into feedback (discription,user_id,email) values ('$msg',". $_SESSION["userId"].",'$email')";
            if($this->conn->insert($stmt)){
                return true;
            }else{
                return false;
            }
        }
    }
}


?>