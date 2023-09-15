<?php

require_once '../../Model/field.php';
require_once '../../Model/organization.php';
require_once '../../Model/project_req.php';
require_once '../../Model/event_req.php';
require_once '../../Model/project.php';
require_once '../../Controller/DBController.php';

class orgController {
    protected $db;      //use as object of database (DBController)

    //1. Open connection.
    //2. Run query & logic.
    //3. Close connection


    /* fields table */
    function getAllFields() {
        $this->db = new DBController;
        if($this->db) {
            $query="select * from field";
            $result = $this->db->select($query);
            $this->db->closeConnection();
            return $result;                      //result = false or array (empty or full)
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    /* request_project page */
    function add_request(project_req $request) {
        $this->db = new DBController;
        if($this->db) {
            $query = "INSERT INTO project_req (description, state, org_id, proj_name, target_amount, field_id, img_url) VALUES ('{$request->get_description()}','waiting',{$request->get_org_id()},'{$request->get_project_name()}',{$request->get_target_amount()},'{$request->get_field_id()}','{$request->get_img_url()}')";
            $result = $this->db->insert($query);            //result = false or last id insert
            $this->db->closeConnection();
            return $result;  
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }

    /* request_event page */
    function add_event(event_req $event) {
        $this->db = new DBController;
        if($this->db) {
            $query = "INSERT INTO event_req (name, time, information, location, org_id, img_url) VALUES
            ('{$event->get_event_name()}','{$event->get_time()}','{$event->get_information()}','{$event->get_location()}',{$event->get_org_id()},'{$event->get_img_url()}')";
            $result = $this->db->insert($query);            //result = false or last id insert
            $this->db->closeConnection();
            return $result;  
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    /* profile page */
    function get_org_id($userId) {
        $this->db = new DBController;
        if($this->db) {
            $query="select id from organization where user_id = $userId";
            $result = $this->db->select($query);
            $this->db->closeConnection();
            return $result[0]['id'];
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    function get_data_org($userId) {
        $this->db = new DBController;
        if($this->db) {
            $query="SELECT organization.id,organization.address,organization.user_id,organization.account_no,user.name,user.email,user.password,user.img_url FROM organization,user WHERE organization.user_id=user.id and organization.user_id=$userId;";
            $result = $this->db->select($query);
            $this->db->closeConnection();
            return $result ;                      
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    function update_info($query) {
        $this->db = new DBController;
        if($this->db) {
            $result = $this->db->update($query);
            $this->db->closeConnection();
            return $result;                      //result = false or array (empty or full)
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    function get_photo_org($userId){
        $this->db = new DBController;
        if($this->db) {
        $query = "SELECT img_url from user where id = $userId";
        $result = $this->db->select($query);
        $this->db->closeConnection();
        return $result;                                     //result = false or array (empty or full)
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    function get_all_project_req($org_id) {
        $this->db = new DBController;
        if($this->db) {
            $query = "SELECT state, org_id, proj_name, target_amount FROM project_req WHERE org_id=$org_id;";
            $result = $this->db->select($query);            
            $this->db->closeConnection();
            return $result;  
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    function get_all_project($org_id) {
        $this->db = new DBController;
        if($this->db) {
            $query = "SELECT project.id, project_req.description,project_req.proj_name,project_req.target_amount,project_req.img_url FROM project, project_req WHERE project_req.org_id=$org_id AND project.req_id=project_req.id;";
            $result = $this->db->select($query);            
            $this->db->closeConnection();
            return $result;  
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    function get_all_event_req($org_id) {
        $this->db = new DBController;
        if($this->db) {
            $query = "SELECT name, time, information, location, img_url ,state FROM event_req WHERE org_id=$org_id;";
            $result = $this->db->select($query);            
            $this->db->closeConnection();
            return $result;  
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    function get_all_event($org_id) {
        $this->db = new DBController;
        if($this->db) {
            $query = "SELECT event.id, event_req.name,event_req.time,event_req.information,event_req.location,event_req.state,event_req.img_url FROM event, event_req WHERE event_req.org_id=$org_id AND event.req_id=event_req.id;";
            $result = $this->db->select($query);            
            $this->db->closeConnection();
            return $result;  
        }
        else {
            // echo "Error in Database Connection";
            return false;
        }
    }


    function delete_org_photo($userId) {
        $this->db = new DBController;
        if($this->db) {
            $query = "UPDATE user SET img_url = '../images/default.png' WHERE id = $userId";
            $result = $this->db->update($query);
            $this->db->closeConnection();
            return $result;                      
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    function update_photo_org($image,$id){
        $this->db = new DBController;
        if($this->db) {
            $query = "UPDATE user SET img_url = '$image'  where id = $id";
            $result = $this->db->update($query);
            $this->db->closeConnection();
            return $result;                      
        }
        else {
            //echo "Error in Database Connection";
            return false;
        }
    }


    function update_password($userId , $new_password) {
        $this->db = new DBController();
        if ($this->db) {
            $query = "UPDATE user SET password = '{$new_password}' WHERE user.id={$userId}";
            $result = $this->db->update($query);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }
        else {
            //echo "Error in Database Connection";
            return false;
        }
    }

    public function get_event_num($id) {
        $this->db = new DBController();
        if ($this->db) {
            $query = "SELECT COUNT(event.id) as count FROM event, event_req WHERE event.req_id = event_req.id And event_req.org_id = {$id};";
            $result = $this->db->select($query);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }
    }

    public function get_event_req_num($id) {
        $this->db = new DBController();
        if ($this->db) {
            $query = "SELECT COUNT(event_req.id) as count FROM event_req WHERE event_req.org_id = $id;";
            $result = $this->db->select($query);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }
    }

    public function get_project_num($id) {
        $this->db = new DBController();
        if ($this->db) {
            $query = "SELECT COUNT(project.id) as count FROM project, project_req WHERE project.req_id = project_req.id And project_req.org_id = $id;";
            $result = $this->db->select($query);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }
    }

    public function get_project_req_num($id) {
        $this->db = new DBController();
        if ($this->db) {
            $query = "SELECT COUNT(project_req.id) as count FROM project_req WHERE project_req.org_id = $id;";
            $result = $this->db->select($query);
            if ($result) {
                return $result;
            } else {
                return false;
            }
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


    //client -> top donor
    function get_top_donor() {
        $this->db = new DBController;
        if($this->db) {
            $query = "SELECT *,user.name,user.img_url AS img FROM donor LEFT JOIN user ON donor.user_id = user.id ORDER BY total_amount DESC LIMIT 10;";
            $result = $this->db->select($query);               
            $this->db->closeConnection();
            return $result;  
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }


    /*function countOfNO_ofProject() {
        $this->db = new DBController;
        $res=array();
        if($this->db) {
            $query="select id from field";
            $fieldsId = $this->db->select($query);
        
            //$this->db->closeConnection();
            foreach ($fieldsId as $fieldsId) {
                $query="SELECT COUNT(state) FROM request WHERE (state='Accepted' OR state='accepted') and field_id = {$fieldsId['id']};";
                $result = $this->db->select($query);
                //echo $result[0]['COUNT(state)'];

            }
            // return $res;
        }
        else {
            echo "Error in Database Connection";
            return false;
        }
    }
    */

}
?>