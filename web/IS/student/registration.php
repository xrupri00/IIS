<?php
  require_once("autorize.php");
  require_once("menu.php");
  require_once("inserting.php");
  require_once("selecting.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
     "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <title>Informační systém - Zkoušky</title>
    <meta http-equiv="content-type" 
    content="text/html; charset=utf-8">
  </head>
  <body>
    <?php showMenu(); ?>
    <h1>Registrace předmětů</h1>
    <table frame='border' rules='all'>
      <caption><h2>Zaregistrované předměty</h2></caption>
      <?php getRegSubjTable($_SESSION['userID']); ?>
    </table>
  </body>
</html>