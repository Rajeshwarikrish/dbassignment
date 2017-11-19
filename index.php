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


class collection  {
   static public function create()  {
     $model = new static::$modelName;
     return $model;
   }

   static public function findAll()  {
      $db = dbConn::getConnection();
      $tableName = get_called_class();
      $sql = 'SELECT * FROM ' . $tableName;
      $statement = $db->prepare($sql);
      $statement->execute();
      $class = static::$modelName;
      $statement->setFetchMode(PDO::FETCH_CLASS,$class);
      $recordSet = $statement->fetchAll();
      return $recordSet;
   }

   static public function findOne($id)  {
      $db = dbConn::getConnection();
      $tableName = get_called_class();
      $sql = 'SELECT * FROM ' . $tableName . ' WHERE id =' . $id;
      $statement = $db->prepare($sql);
      $statement->execute();
      $class = static::$modelName;
      $statement->setFetchMode(PDO::FETCH_CLASS,$class);
      $recordSet = $statement->fetchAll();
      return $recordSet;
   }
}
   class accounts extends collection  {
      public static $modelName = 'account';
   }

   class todos extends collection  {
      public static $modelName = 'todo';
   }

   class model  {
      protected $table;
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
     $db = dbConn::getConnection();
     $table = $this->table;
     $arr = get_object_vars($this);
     array_pop($arr);
     $heading = array_keys($arr);
     $columnString = implode(',',$heading);
     $valueString = ':' . implode(',:',$heading);
     $query = 'INSERT INTO ' . $table . (' . $columnString . ') 'VALUES' (' .
     $valueString . ');
     $statement = $db->prepare($query);
     $statement->execute($arr);
   }

   public function update($id)  {
    $db = dbConn::getConnection();
    $table = $this->table;
    $arr = get_object_vars($this);
    array_pop($arr);
    $heading = array_keys($arr);
    $Array = array();
    $Value = array();
    foreach($arr as $key=> $value)  {
       if($value!='')  {
          array_push($Value, $key . '=' . ':' . $key);
	  Array[$key] = $value;
       }
    }
    $str = implode(',',$Value);
    $query = 'UPDATE ' . $table . ' SET ' . $str . 'WHERE id=' .$id;
    $statement = $db->prepare($query);
    $statement->execute($Array);
  }
   public function delete()  {
    
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
