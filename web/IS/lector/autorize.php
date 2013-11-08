<?php
  session_start();
  if($_SESSION['userLogged'] != true || $_SESSION['userType'] != "lector")
    header("Location: ../index.php");

?>