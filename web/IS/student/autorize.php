<?php
  session_start();
  if($_SESSION['userLogged'] != true || $_SESSION['userType'] != "student")
    header("Location: ../index.php");

?>