<?php
define('DATABASE', 'rk633');
define('USERNAME', 'rk633');
define('PASSWORD', 'LKVWAEKo');
define('CONNECTION', 'sql.njit.edu');

class dbConn {
protected static $db;
  private function __construct() {
       try  {
	     self::$db = new PDO( 'mysql:host=' . CONNECTION . ';dbname='
	     . DATABASE, USERNAME, PASSWORD );
	     self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	     echo 'Connection Successful<br>';
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
?>