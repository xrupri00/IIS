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
    <h1>Správa uživatelů</h1>
    
    <?php 
      if(isset($_POST['submit'])):
        if(insertUser($_POST['userType'], $_POST['name'], $_POST['surname'], $_POST['degrees']))
          echo "Uživatel přidán.<br>";
        else
          echo "Uživatele se nepodařilo přidat!<br>";
        endif;
      $script_url = $_SERVER['PHP_SELF'];  
      echo "<form action='$script_url' method='post'>"; ?>
    Jméno:
    <input type="text" name="name"><br>
    Příjmení:
    <input type="text" name="surname"><br>
    Tituly:
    <input type="text" name="degrees"><br>
    Typ uživatele:
    <select name="userType">
      <option value="lector">Učitel</option>
      <option value="student">Student</option>
    </select><br>
    <input type="submit" name="submit" value="Přidat">
    </form>
    
    <table frame='border' rules='all'>
      <caption><h2>Seznam studentů</h2></caption>
      <?php getTableRows("student"); ?>
    </table>
    
    <table frame='border' rules='all'>
      <caption><h2>Seznam učitelů</h2></caption>
      <?php getTableRows("lector"); ?>
    </table>
    
  </body>
</html>