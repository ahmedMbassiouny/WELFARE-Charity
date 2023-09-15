<?php

require_once "../../Controller/DBController.php";

class eventController{
    protected $conn;


    public function viewEvents(){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="select * from event inner join event_req on req_id=event_req.id";
            $result=$this->conn->select($stmt);
            if($result){
                return $result;
            }else{
                return false;
            }
        }
    }




    public function searchEvent($value){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="select * from event where name = '$value'";
            $result=$this->conn->select($stmt);
            if($result){
                return $result;
            }else{
                return false;
            }
        }
    }
}


?>