<?php
  define("DBHOST", "localhost");
  define("DBLOGIN", "iis-proj");
  define("DBPASSWD", "123456");
  define("DBNAME", "iszkousky");
  
  function connectDB()
  {
    mysql_connect(DBHOST, DBLOGIN, DBPASSWD) or die("Nelze se připojit k databázi: ").mysql_error();
    mysql_select_db(DBNAME) or die("Nelze se připojit k databázi: ").mysql_error();
  }

?>