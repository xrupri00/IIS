<?php
  include "database.php";
   
  function autorize($name, $passwd, $userType)
  {
    connectDB();
    if($userType == "admin"){
      if($name == "admin" && $passwd == "admin")
        return true;
      else
        return false;
    }elseif($userType == "student" || $userType == "lector"){
      if(!($result = mysql_query("select id from login_$userType where 
                    login='$name' and passwd='$passwd'")))
                    return false;    
    }else
      return false;
    
    $count = mysql_num_rows($result);
      
    if($count == 1):
      $record = MySQL_Fetch_Array($result);
      return $record['id'];    
    endif;
    
    return false;   
  }      
?>