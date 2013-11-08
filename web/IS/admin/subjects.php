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
    <h1>Správa Předmětů</h1>

      <?php 
      if(isset($_POST['submit'])):
        if(insertSubject($_POST['name'], $_POST['subjType'], $_POST['lectorID']))
          echo "Předmět přidán.<br>";
        else
          echo "Předmět se nepodařilo přidat!<br>";
        endif;
      
      $script_url = $_SERVER['PHP_SELF'];   
      echo "<form action='$script_url' method='post'>"; ?>
    Zkratka:
    <input type="text" name="name"><br>
    Typ:
    <input type="text" name="subjType"><br>
    Garant:
    <select name="lectorID">
    <?php 
      getUsersOptions("lector");
    ?>
    </select><br>
    <input type="submit" name="submit" value="Přidat">
    </form>
    
    <table frame='border' rules='all'>
      <caption><h2>Seznam předmětů</h2></caption>
      <?php getTableRows("subject"); ?>
    </table>
    
  </body>
</html>