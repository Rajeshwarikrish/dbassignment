<?php
ini_set('display_errors','On');
error_reporting(E_ALL);

define('DATABASE', 'rk633');
define('USERNAME', 'rk633');
define('PASSWORD', 'LKVWAEKo');
define('CONNECTION', 'sql.njit.edu');

class dbConn {
protected static $db;
  private function __construct() {
       try  {
	     self::$db = new PDO('mysql:host=' . CONNECTION .';dbname='
	     . DATABASE, USERNAME, PASSWORD );
	     self::$db->setAttribute( PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
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
   static public function create()  {
     $model = new static::$modelName;
     return $model;
   }

/*   static public function query($sql)   {
      $statement = $db->prepare($sql);
      $statement->execute();
      $class = static::$modelName;
      $statement->setFetch(PDO::FETCH_CLASS, $class);
      $recordSet = $statement->fetchAll();
      return $recordset;
}*/

   static public function findAll()  {
      $db = dbConn::getConnection();
      $tableName = get_called_class();
      $sql = 'SELECT * FROM ' . $tableName;
      //$res_query=query($sql);
      $statement = $db->prepare($sql);
      $statement->execute();
      $class = static::$modelName;
      $statement->setFetchMode(PDO::FETCH_CLASS, $class);
      $recordSet = $statement->fetchAll();
      return $recordSet;
      //echo $res_query;
   }

   static public function findOne($id)  {
      $db = dbConn::getConnection();
      $tableName = get_called_class();
      $sql = 'SELECT * FROM ' . $tableName . 'WHERE id =' . $id;
      $statement = $db->prepare($sql);
      $statement->execute();
      $class = static::$modelName;
      $statement->setFetchMode(PDO::FETCH_CLASS, $class);
      $recordSet = $statement->fetchAll();
      //$res_query=query($sql);
      return $recordset[0];
      //echo $res_query[0];
   }
}
   class accounts extends collection  {
      protected static $modelName = 'account';
   }

   class todos extends collection  {
      protected static $modelName = 'todo';
   }

   class model  {
      protected $tableName;
      public function save()  {
        if ($this->id = ' ')  {
	  $sql = $this->insert();

	} else {
	  $sql = $this->update();
	}
	$db = dbConn::getConnection();
	$statement = $db->prepare($sql);
	$statement->execute();
	$tableName = get_called_class();
	$array = get_object_vars($this);
	$columnString = implode(',', $array);
	$valueString = ":".implode(',:',$array);
	echo 'Record Saved: ' .$this->id;
      }

   public function insert()  {
      $sql = 'something';
      return $sql;
   }
   private function update()  {
      $sql = 'something';
      return $sql;
      echo "Updated successfully";
   }
   public function delete()  {
      echo 'I deleted record' . $this->id;
   }
}
class account extends model  {

}

class todo extends model  {
   public $id;
   public $ownermail;
   public $ownerid;
   public $createddate;
   public $duedate;
   public $message;
   public $isdone;

   public function __construct()
   {
       $this->tableName = 'todos';
   }
}
$records = accounts::findAll();
$records = todos::findAll();
$record = todos::findOne(1);
$record = new todo();
$record->message = 'some task';
$record->isdone = 0;
print_r($record);
print_r($record);



     ?> 
















>
