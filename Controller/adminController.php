<?php

require_once '../../Controller/DBController.php';
require_once '../../Model/user.php';
require_once '../../Model/donation.php';
require_once '../../Model/donor.php';
require_once '../../Model/payment_plan.php';

class adminController
{
  protected $db;

  ///////////////Admin////////////////////////
  public function getAdminData($user_id)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "SELECT * FROM user WHERE user.id=$user_id ";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }

  public function editAdminData(user $admin)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "UPDATE user SET name='{$admin->get_name()}', email='{$admin->get_email()}', img_url='{$admin->get_image()}' WHERE user.id={$admin->get_id()}";
      $result = $this->db->update($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }
  public function editPassword($user_id, $new_password)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "UPDATE user SET password = '{$new_password}' WHERE user.id={$user_id}";
      $result = $this->db->update($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }

  ///////////////donation////////////////////////
  public function getAlldonations()
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "SELECT donation.id AS id, donation.user_id, donation.sec_name AS name, project_req.proj_name AS project, donation.amount AS amount, payment_method.name AS method, donation.start_time AS time, donation.email AS email, donation.address AS address, donation.phone AS phone FROM project, donation, payment_method, project_req, user WHERE payment_method.id = donation.pay_meth_id AND project.id = donation.proj_id AND project.req_id = project_req.id AND user.id = donation.user_id";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }

  public function getDonationNum()
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "SELECT COUNT(id) as count FROM donation";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function getTotalDonationAmount()
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "SELECT SUM(amount) as total FROM donation";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }
  ///////////////donor////////////////////////
  public function getAlldonors()
  {
    $this->db = new DBController();
    if ($this->db) {
      //SELECT donation.id as id, donor.id as donor_id,donation.user_id as user_id,donation.name as name,request.proj_name as project ,donation.amount as amount,payment_method.name as method,donation.time as time,donation.email as email,donation.address as address,donation.phone as phone FROM project, donation ,payment_method,request ,donor WHERE payment_method.id=donation.pay_meth_id AND project.id=donation.proj_id AND project.req_id=request.id; AND donor.id=donation.donor_id
      $stmt = "SELECT donor.id as id, user.id as user_id ,user.name as name,donor.total_amount as total_amount ,donor.donations_num as donations_num,donor.points as points FROM donor, user WHERE donor.user_id=user.id;";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function getDonorsNum()
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "SELECT COUNT(id) as count FROM donor";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }
  ///////////////volunteer////////////////////////
  public function getAllvolunteers()
  {
    $this->db = new DBController();
    if ($this->db) {
      //SELECT donation.id as id, donor.id as donor_id,donation.user_id as user_id,donation.name as name,request.proj_name as project ,donation.amount as amount,payment_method.name as method,donation.time as time,donation.email as email,donation.address as address,donation.phone as phone FROM project, donation ,payment_method,request ,donor WHERE payment_method.id=donation.pay_meth_id AND project.id=donation.proj_id AND project.req_id=request.id; AND donor.id=donation.donor_id
      $stmt = "SELECT volunteer.id as id, user.id as user_id ,user.name as name,volunteer.no_of_event as no_of_event ,volunteer.phone_no as phone_no,volunteer.email as email FROM volunteer, user WHERE volunteer.user_id=user.id;";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function getVolunteersNum()
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "SELECT COUNT(id) as count FROM volunteer";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }
  ///////////////organizations////////////////////////
  public function getAllorganizations()
  {
    $this->db = new DBController();
    if ($this->db) {
      //SELECT donation.id as id, donor.id as donor_id,donation.user_id as user_id,donation.name as name,request.proj_name as project ,donation.amount as amount,payment_method.name as method,donation.time as time,donation.email as email,donation.address as address,donation.phone as phone FROM project, donation ,payment_method,request ,donor WHERE payment_method.id=donation.pay_meth_id AND project.id=donation.proj_id AND project.req_id=request.id; AND donor.id=donation.donor_id
      $stmt = "SELECT organization.id AS id, organization.user_id AS user_id, user.name AS name, organization.account_no AS account_no, organization.address AS address, user.email AS email FROM organization, user WHERE organization.user_id = user.id;";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function getOrganizationsNum()
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "SELECT COUNT(id) as count FROM organization";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }
  ///////////////feedbacks////////////////////////
  public function getAllfeedbacks()
  {
    $this->db = new DBController();
    if ($this->db) {
      //SELECT donation.id as id, donor.id as donor_id,donation.user_id as user_id,donation.name as name,request.proj_name as project ,donation.amount as amount,payment_method.name as method,donation.time as time,donation.email as email,donation.address as address,donation.phone as phone FROM project, donation ,payment_method,request ,donor WHERE payment_method.id=donation.pay_meth_id AND project.id=donation.proj_id AND project.req_id=request.id; AND donor.id=donation.donor_id
      $stmt = "SELECT feedback.id AS id, feedback.user_id AS user_id, user.name AS name, role.name AS role, feedback.email AS email, feedback.discription AS discription FROM feedback, user ,role WHERE feedback.user_id = user.id AND role.id=user.role_id ORDER BY id;";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function getFeedbacksNum()
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "SELECT COUNT(id) as count FROM feedback";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }

  ///////////////project project req////////////////////////

  function getAllProjectReq()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT project_req.id AS id , description , org_id , proj_name ,state,target_amount AS target ,img_url AS img ,field.name AS field FROM project_req ,field WHERE field.id=project_req.field_id ORDER BY project_req.id ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getProjectReqNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(id) as count FROM project_req";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  public function acceptProject($req_id)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "UPDATE project_req SET state = 'accepted' WHERE project_req.id={$req_id}";
      $result = $this->db->update($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }



  public function rejectproject($req_id)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "UPDATE project_req SET state = 'rejected' WHERE project_req.id={$req_id}";
      $result = $this->db->update($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  public function AddProject($req_id)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "INSERT INTO `project` (`id`, `req_id`) VALUES (NULL, '{$req_id}')";
      $result = $this->db->insert($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  function getAllProjects()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT project.id, project.req_id, project_req.org_id, project_req.description, project_req.proj_name AS project, project_req.target_amount AS target, project_req.img_url AS img, field.name as field, ( SELECT COUNT(user_id) FROM donation WHERE donation.proj_id = project.id ) AS donors, ( SELECT SUM(amount) FROM donation WHERE donation.proj_id = project.id ) AS collect FROM project, project_req, field WHERE project.req_id = project_req.id AND project_req.field_id = field.id AND project.id IS NOT NULL GROUP BY project.id, project_req.org_id, field.name;";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getacceptedProjectNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(project_req.id) as count FROM project_req WHERE project_req.state='accepted' ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  public function getProjectNum()
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "SELECT COUNT(id) as count FROM project";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }

  function getWaitingProjectNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(project_req.id) as count FROM project_req WHERE project_req.state='waiting' ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getRejectedProjectNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(project_req.id) as count FROM project_req WHERE project_req.state='rejected' ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }


  /////////////// event req////////////////////////

  function getAllEventReq()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT event_req.id AS id , location , information as info , org_id , name ,state,time ,img_url AS img  FROM event_req  ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getEventReqNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(id) as count FROM event_req";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getRegistrationNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(id) as count FROM registration";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getWaitingEventNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(event_req.id) as count FROM event_req WHERE event_req.state='waiting' ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getRejectedEventNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(event_req.id) as count FROM event_req WHERE event_req.state='rejected' ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getAcceptedEventNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(event_req.id) as count FROM event_req WHERE event_req.state='accepted' ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }


  public function acceptEvent($req_id)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "UPDATE event_req SET state = 'accepted' WHERE event_req.id={$req_id}";
      $result = $this->db->update($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }

  public function rejectEvent($req_id)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "UPDATE event_req SET state = 'rejected' WHERE event_req.id={$req_id}";
      $result = $this->db->update($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }

  public function AddEvent($req_id)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "INSERT INTO `event` (`id`, `req_id`) VALUES (NULL, '{$req_id}')";
      $result = $this->db->insert($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }


  function getAllEvents()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT event.id, event.req_id, event_req.org_id, event_req.information, event_req.name , event_req.time , event_req.img_url AS img, event_req.location, ( SELECT COUNT(id) FROM registration WHERE registration.event_id = event.id ) AS volunteers FROM event , event_req, field WHERE event.req_id = event_req.id AND event.id IS NOT NULL GROUP BY event.id, event_req.org_id;";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }


  public function getEventNum()
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "SELECT COUNT(id) as count FROM event";
      $result = $this->db->select($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }

  /////////////// payment_plan ////////////////////////

  function getAllPaymentPlans()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT payment_plan.id AS id , payment_plan.name , payment_plan.duration  FROM payment_plan  ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getPaymentPlansNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(id) as count FROM payment_plan";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  public function add_payment_plan(payment_plan $plan)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "INSERT INTO `payment_plan` (`id`, `duration`, `name`) VALUES (NULL, '{$plan->get_duration()}', '{$plan->get_name()}')";
      $result = $this->db->insert($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }

  /////////////// payment_method ////////////////////////

  function getAllPaymentMethods()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT payment_method.id , payment_method.name FROM payment_method  ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getPaymentMethodsNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(id) as count FROM payment_method";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  public function add_payment_method(payment_method $method)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "INSERT INTO `payment_method` (`id`, `name`) VALUES (NULL,'{$method->get_name()}')";
      $result = $this->db->insert($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }
  /////////////// field ////////////////////////

  function getAllFields()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT field.id , field.name FROM field  ";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  function getFieldsNum()
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "SELECT COUNT(id) as count FROM field";
      $result = $this->db->select($query);
      $this->db->closeConnection();
      return $result;
    } else {
      echo "Error in Database Connection";
      return false;
    }
  }

  public function add_field(field $field)
  {
    $this->db = new DBController();
    if ($this->db) {
      $stmt = "INSERT INTO `field` (`id`, `name`) VALUES (NULL,'{$field->get_name()}')";
      $result = $this->db->insert($stmt);
      if ($result) {
        return $result;
      } else {
        return false;
      }
    }
  }

  function check_email($email)
  {
    $this->db = new DBController;
    if ($this->db) {
      $query = "select email from user;";
      $results = $this->db->select($query);
      $this->db->closeConnection();
      foreach ($results as $result) {
        if ($result['email'] == $email) {
          return false;
        }
      }
      return true;
    } else {
      //echo "Error in Database Connection";
      return false;
    }
  }
}
