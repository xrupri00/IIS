<?php
  require_once("../database.php");
  
  function getUsersOptions($UserType)
  {
    connectDB();
    
    $result = mysql_query("select * from $UserType");
    
    while($record = MySQL_Fetch_Array($result))
    {
      $id = $record['id'];
      $name = $record['name'];
      $surname = $record['surname'];
      $degrees = $record['degrees'];
      echo "<option value='$id'>";
      echo "$name $surname, $degrees";
      echo "</option><br>";
    }
  }
  
  function getTableRows($tableName)
  {
    connectDB();
    
    $result = mysql_query("select * from $tableName");
    
    if(mysql_num_rows($result) == 0)
    {
      echo "Nenalezeny žádné záznamy!";
      return false;
    }
  
    if($tableName == "subject")
      echo "<tr><th>Zkratka<th>Typ<th>Garant";
    else
      echo "<tr><th>Jméno<th>Příjmení<th>Tituly";
      
    while($record = MySQL_Fetch_Array($result))
    {
      if($tableName == "subject"):
        $first = $record['acronym'];
        $second = $record['type'];
        $id = $record['id_garant'];
        $lectorResult = mysql_query("select * from lector where id='$id'");
        $lectorRecord = MySQL_Fetch_Array($lectorResult);
        $third =  $lectorRecord['name']." ".$lectorRecord['surname'].", ".$lectorRecord['degrees'];
      else:
        $first = $record['name'];
        $second = $record['surname'];
        $third = $record['degrees'];
      endif;
      
      echo "<tr><td>$first<td>$second<td>$third";
    }  
  
    return true;
  }
  
?>