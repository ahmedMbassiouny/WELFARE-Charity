<?php

// requires
require_once '../../Model/user.php';
require_once '../../Model/organization.php';
require_once '../../Model/role.php';
require_once '../../Controller/DBController.php';


class Authcontroller {
    protected $db;      //use as object of database (DBController)

    //1. Open connection.
    //2. Run query & logic.
    //3. Close connection


    function login(user $user) {
        $this->db = new DBController;
        if($this->db) {
            $query="select * from user where email='{$user->get_email()}' and password='{$user->get_password()}'";
            $result = $this->db->select($query);         
            if($result === false) {
                //echo "Error in Query";
                return false;
            }
            else {
                if(count($result) == 0) {
                    // session_start();
                    // $_SESSION["errMsg"] = "You have entered wrong email or password";
                    $this->db->closeConnection();
                    return false;
                }
                else {
                    /*print_r($result);*/  //Array ( [0] => Array ( [id] => 1 [name] => ahmed [email] => ahmed123@gmail.com [password] => 12345 [roleid] => 1 ) )
                    session_start();
                    $_SESSION["userId"]=$result[0]["id"];
                    $_SESSION["userRole"]=$result[0]["role_id"];
                    // $_SESSION["userName"]=$result[0]["name"];
                    $this->db->closeConnection();
                    return true;
                }
            }
        }
        else {
            //echo "Error in Database Connection";
            return false;
        }
    }


    function register(user $user) {
        $this->db = new DBController;
        if($this->db) {
            $query = "insert into user values ('','{$user->get_name()}','{$user->get_email()}','{$user->get_password()}',2,'../images/default.png')";
            $result = $this->db->insert($query);
            if($result === false) {
                $this->db->closeConnection();
                return false;
            }
            else {
                $this->db->closeConnection();
                return true;
            }
        }
        else {
            //echo "Error in Database Connection";
            return false;
        }
    }


    function register_org(user $user ,organzation $org) {
        $this->db = new DBController;
        if($this->db) {
            $query = "insert into user values ('','{$user->get_name()}','{$user->get_email()}','{$user->get_password()}',3,'../images/default.png')";
            $result = $this->db->insertOrg($query);
            if($result === false) {
                $this->db->closeConnection();
                return false;
            }
            else {
                $query1 = "insert into organization values ('','{$org->get_address()}',$result,{$org->get_account_num()})";
                $result1 = $this->db->insert($query1);
                if($result1 === false) {
                    $this->db->closeConnection();
                    return false;
                }
                else {
                $this->db->closeConnection();
                return true;
                }
            }
        }
        else {
            //echo "Error in Database Connection";
            return false;
        }
    }


    function check_email($email) {
        $this->db = new DBController;
        if($this->db) {
            $query="select email from user;";
            $results = $this->db->select($query);
            $this->db->closeConnection();
            foreach($results as $result) {
                if($result['email'] == $email) {
                    return false;
                }
            }
            return true;
        }
        else {
            //echo "Error in Database Connection";
            return false;
        }
    }

}
?>