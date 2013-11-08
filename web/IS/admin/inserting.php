<?php

  require_once("../database.php");

  function utf2ascii($text)
  {
    static $table = array("\xc3\xa1"=>"a","\xc3\xa4"=>"a","\xc4\x8d"=>"c",
                        "\xc4\x8f"=>"d","\xc3\xa9"=>"e","\xc4\x9b"=>"e",
                        "\xc3\xad"=>"i","\xc4\xbe"=>"l","\xc4\xba"=>"l",
                        "\xc5\x88"=>"n","\xc3\xb3"=>"o","\xc3\xb6"=>"o",
                        "\xc5\x91"=>"o","\xc3\xb4"=>"o","\xc5\x99"=>"r",
                        "\xc5\x95"=>"r","\xc5\xa1"=>"s","\xc5\xa5"=>"t",
                        "\xc3\xba"=>"u","\xc5\xaf"=>"u","\xc3\xbc"=>"u",
                        "\xc5\xb1"=>"u","\xc3\xbd"=>"y","\xc5\xbe"=>"z",
                        "\xc3\x81"=>"A","\xc3\x84"=>"A","\xc4\x8c"=>"C",
                        "\xc4\x8e"=>"D","\xc3\x89"=>"E","\xc4\x9a"=>"E",
                        "\xc3\x8d"=>"I","\xc4\xbd"=>"L","\xc4\xb9"=>"L",
                        "\xc5\x87"=>"N","\xc3\x93"=>"O","\xc3\x96"=>"O",
                        "\xc5\x90"=>"O","\xc3\x94"=>"O","\xc5\x98"=>"R",
                        "\xc5\x94"=>"R","\xc5\xa0"=>"S","\xc5\xa4"=>"T",
                        "\xc3\x9a"=>"U","\xc5\xae"=>"U","\xc3\x9c"=>"U",
                        "\xc5\xb0"=>"U","\xc3\x9d"=>"Y","\xc5\xbd"=>"Z"); 
    return strtr($text, $table);
  }

  function genPasswd()
  {
    return "heslo";
  }
  
  function genLogin($userType, $name, $surname)
  {
    connectDB();
    $name = utf2ascii($name);
    $surname = utf2ascii($surname);
    $name = strtolower($name);
    $surname = strtolower($surname);
    $login = "x".substr($surname, 0, 5);
    if(strlen($login) < 6)
      $login .= substr($name, 0, 6 - strlen($login));
    
    $result = mysql_query("select count(*) as number from login_$userType 
                             where login like '$login%'");

    $record = MySQL_Fetch_Array($result);
    $login .= "%02d";
    $login = sprintf($login, $record['number']);

    return $login;
  
  }

  function insertUser($userType, $name, $surname, $degrees)
  {
    connectDB();
    
    $login = genLogin($userType, $name, $surname);
    $passwd = genPasswd();
    $request = "insert into login_$userType (login, passwd) values('$login','$passwd')";
    if(!mysql_query($request))
      return false;
      
    $request = "select id from login_$userType where login='$login'";
      
    $result = mysql_query($request);
    $record = MySQL_Fetch_Array($result);
    $id = $record['id'];
    $request = "insert into $userType values('$id','$name','$surname','$degrees')";
    if(!mysql_query($request)){
      $request = "delete from login_$userType where id='$id'";
      mysql_query($request);
      return false;
    }
     
    return true;
  }

  function insertSubject($name, $type, $garantID)
  {
    connectDB();
    $request = "insert into subject(acronym, type, id_garant) values('$name','$type','$garantID')";

    if(!mysql_query($request))
    {
      echo mysql_error();
      return false;
    }
    
    $request = "select id from subject where acronym='$name'";
    
    if(!($result = mysql_query($request))):
      echo mysql_error();
      $request = "delete from subject where acronym='$name'";
      mysql_query($request);
      return false;
    endif;
    
    $record = MySQL_Fetch_Array($result);
    $id = $record['id']; 
    $request = "insert into lector_subject values('$garantID','$id')";
    
    if(!mysql_query($request)):
      echo mysql_error();
      $request = "delete from subject where acronym='$name'";
      mysql_query($request);
      return false;
    endif;
                         
    return true;
  }

?>