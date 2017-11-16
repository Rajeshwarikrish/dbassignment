<?php
ini_set('display_errors','On');
error_report(E_ALL);

define('DATABASE', 'rk633');
define('DATABASE', 'rk633');
define('PASSWORD', 'LKVWAEKo');
define('CONNECTION', 'sql2.njit.edu');

class dbConn {
protected static $db;
  private function __construct() {
       try  {
	     self::$db = new PDO('mysql:host=' . CONNECTION .';DBNAME='
	     .DATABASE, USERNAME, PASSWORD );
	     self::$db->setAttribute( PDO::ATTR_ERRMODE,
	     PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)  {
	     echo "Connection Error:" . $e->getMessage();
	}
}

  public static function getConnection()  {
       if (!self::$db)  {
         new dbConn();
       }
       return self::$db;
  }
}






















>
