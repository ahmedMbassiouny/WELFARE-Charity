<?php

class DBController{

    private $DBhost ="localhost";
    private $DBusername="root";
    private $DBpassword="";
    private $DBname="charity";
    private $conn=null;



    function __construct(){
        $this->conn=new mysqli($this->DBhost,$this->DBusername,$this->DBpassword,$this->DBname);

        if($this->conn->connect_error){
            echo $this->conn->connect_error;
        }
    }



/*
    public function openConnection(){
        $this->conn=new mysqli($this->DBhost,$this->DBusername,$this->DBpassword,$this->DBname);

        if($this->conn->connect_error){
            echo $this->conn->connect_error;
            return false;
        }
        return true;
    }
*/



    public function select($stmt){
        $result=$this->conn->query($stmt);
        if($result->num_rows>0){
            while($row=$result->fetch_all(MYSQLI_ASSOC)){
                return $row;
            }
        }else{
            return false;
        }
    }







    public function insert($stmt){
        $result =$this->conn->query($stmt);
        if($result===true){
            return true;
        }else{
            return false;
        }
    }







    public function update($stmt){
        $result=$this->conn->query($stmt);
        if($result===true){
            return true;
        }else{
            return false;
        }
    }






    public function delete($stmt){
        $result=$this->conn->query($stmt);
        if($result===true){
            return true;
        }else{
            return false;
        }
    }




    public function getLastId(){
        return $this->conn->insert_id;
    }




    public function getConnectionError(){
        return $this->conn->connect_error;
    }



    public function search_id($attName,$table,$id){
        $query = "SELECT $attName from $table where $attName=$id ";
        $res = $this->select($query);
        if($res){
            return count($res);
        }else{
            return false;
        }
        
    }


    public function closeConnection(){
        $this->conn->close();
        return true;
    }

}
