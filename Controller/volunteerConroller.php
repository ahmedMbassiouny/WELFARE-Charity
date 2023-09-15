<?php

require_once "../../Controller/DBController.php";
require_once "../../Model/volunteer.php";

class volunteerController{
    protected $conn;




    public function checkValidate($user_id){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="select * from volunteer where user_id=$user_id";
            $result=$this->conn->select($stmt);
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function checkRegisterd($event_id,$vol_id){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="select * from registration where event_id=$event_id and vol_id=$vol_id";
            $result=$this->conn->select($stmt);
            if($result){
                return true;
            }else{
                return false;
            }
        }return false;
    }

    public function beVolunteer($no_of_event,$user_id){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="insert into volunteer (no_of_event,user_id) values ($no_of_event,$user_id)";
            $result=$this->conn->insert($stmt);
            if($result){
                return $this->conn->getLastId();
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    public function getVolId($user_id){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="select id from volunteer where user_id=$user_id";
            $result=$this->conn->select($stmt);
            if($result){
                return $result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



    public function regesterInEvent($event_id,$vol_id,$phone_no,$address,$message){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="insert into registration (event_id,vol_id,phone_no,address,message) values ($event_id,$vol_id,'$phone_no','$address','$message')";
            $result=$this->conn->insert($stmt);
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



    public function getNoOfEvents($user_id){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="select no_of_event from volunteer where user_id=$user_id";
            $result=$this->conn->select($stmt);
            if($result){
                return $result;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    public function updateVolunteer($no_of_event,$user_id){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="update volunteer set no_of_event=$no_of_event where user_id=$user_id";
            $result=$this->conn->update($stmt);
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}



?>