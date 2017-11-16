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


class collection  {
   static public function createtable()  {
     $model = new ststic::$modelName;
     return $model;
   }

   static public function query(sql)   {
      $statement = $db->prepare($sql);
      $statement->execute();
      $class = static::$modelName;
      $statement->setFetch(PDO::FETCH_CLASS, $class);
      $recordSet = $statement->fetchAll();
      return $recordset;
}

   static public function findAll()  {
      $db = dbConn::getConnection();
      $tableName = get_called_class();
      $sql = 'SELECT * FROM ' . $tableName;
      res_query=query(sql);
    /*  $statement = $db->prepare($sql);
      $statement->execute();
      $class = static::$modelName;
      $statement->setFetch(PDO::FETCH_CLASS, $class);
      $recordSet = $statement->fetchAll();
      return $recordSet;*/
      echo $res_query;
   }

   static public function findOne()  {
      $db = dbConn::getConnection();
      $tableName = get_called_class();
      $sql = 'SELECT * FROM ' . $tableName . 'WHERE id = ' . $id;
      res_query=query(sql);
      //return $recordset[0];
      echo $resquery[0];
   }



















>
