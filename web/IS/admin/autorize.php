<?php
  session_start();
  if($_SESSION['userLogged'] != true || $_SESSION['userType'] != "admin")
    header("Location: ../index.php");

?>