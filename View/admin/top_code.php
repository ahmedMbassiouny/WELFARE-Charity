<?php
// $_SESSION["userId"] = 4;
// $_SESSION["roleId"] = 1;

  //dont enter untill login
  // session_start();
  if (!isset($_SESSION["userId"])) {
    header("location:../auth/login.php ");
  } else {
    if ($_SESSION["userRole"] != 1) {
      header("location:../auth/login.php ");
    }
  }


require_once "../../Controller/adminController.php";
require_once '../../Model/user.php';

$adminCN = new adminController();
$admin = new user();

$data = $adminCN->getAdminData($_SESSION['userId']);

$admin->set_id($data[0]['id']);
$admin->set_name($data[0]['name']);
$admin->set_email($data[0]['email']);
$admin->set_password($data[0]['password']);
$admin->set_image($data[0]['img_url']);

$_SESSION["email"] = $admin->get_email();
?>