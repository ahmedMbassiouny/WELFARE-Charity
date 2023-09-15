<?php

require_once "../../Model/user.php";
require_once "../../Controller/DBController.php";

class userController extends user{
    protected $conn;



    public function giveFeedback($email,$msg){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="insert into feedback (discription,user_id,email) values ('$msg',1,'$email')";
            if($this->conn->insert($stmt)){
                return true;
            }else{
                return false;
            }
        }
    }
}


?>