<?php
require_once "../../Controller/DBController.php";


class projectController{
    protected $conn;


    public function viewProjects(){
        $this->conn=new DBController();
        if($this->conn){
            $stmt= "select project.id as proj_id ,project.req_id, project_req.* from project ,project_req WHERE req_id=project_req.id;";
            $result=$this->conn->select($stmt);
            if($result){
                return $result;
            }else{
                return false;
            }
        }
    }


    public function getAllPlans(){
        $this->conn=new DBController();
        if($this->conn){
            $stmt="select * from payment_plan ";
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