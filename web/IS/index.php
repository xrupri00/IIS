<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
     "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <title>Informační systém - Zkoušky</title>
    <meta http-equiv="content-type" 
    content="text/html; charset=utf-8">
  </head>
  <?php require("autorization.php");?>
  <body>  
    <h1>Přihlášení</h1> <br>
    <?php 
    if(isset($_POST['submit'])):
      if($_POST['userType'] == "student" || $_POST['userType'] == "lector" 
         || $_POST['userType'] == "admin"):
        if($id = autorize($_POST['login'], $_POST['passwd'], $_POST['userType'])):
          session_start();
          $_SESSION['userLogged'] = true;
          $_SESSION['userType'] = $_POST['userType'];
          $_SESSION['userID'] = $id;
          header("Location: ".$_POST['userType']);
        else:
          echo "Přihlášení se nezdařilo.<br>";
          echo "<a href=".$_SERVER['PHP_SELF']."?type=".$_POST['userType'].">Zpět k přihlašování.</a><br>";
        endif;        
      else:
        echo "Neznámá skupina uživatelů.<br>";
        echo "<a href=".$_SERVER['PHP_SELF'].">Zpět na úvodní stránku.</a><br>";
      endif;
    elseif(isset($_GET['type'])):?>
      <div>
        <form method=post action=<?php echo $_SERVER['PHP_SELF'];?>>
          Jméno:    
          <input type=text name=login>
          Heslo:
          <input type=password name=passwd value=""><br>
          <input type=hidden name=userType value=<?php echo $_GET['type'];?>>
          <input type=submit name=submit value=Přihlásit>
        </form>
      </div>
      <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Zpět na úvodní stránku.</a><br><?php 
    else:?>
      <a href="<?php echo $_SERVER['PHP_SELF'].'?type=student' ?>">Student</a><br>
      <a href="<?php echo $_SERVER['PHP_SELF'].'?type=lector' ?>">Učitel</a><br>
      <a href="<?php echo $_SERVER['PHP_SELF'].'?type=admin' ?>">Administrátor</a><br><?php
    endif;?>  
  </body>
</html>  