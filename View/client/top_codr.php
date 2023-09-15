<?php
// $_SESSION["userId"] = 4;
// $_SESSION["roleId"] = 1;

  //dont enter untill login
  // session_start();
  if (!isset($_SESSION["userId"])) {
    header("location:../auth/login.php ");
  } else {
    if ($_SESSION["userRole"] != 2) {
      header("location:../auth/login.php ");
    }
  }

?>