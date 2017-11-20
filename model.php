<?php
   class model  {
      protected $table;
      public function save()  {
       if ($this->id == '')  {
	   $this->insert();

	} else {
	   $this->update($this->id);
	} 
      }

   public function insert()  {
     $db = dbConn::getConnection();
     $table = $this->table;
     $arr = get_object_vars($this);
     array_pop($arr);
     $heading = array_keys($arr);
     $columnString = implode(',',$heading);
     $valueString = ':' . implode(',:',$heading);
     $query = 'INSERT INTO ' . $table . ' (' . $columnString . ') VALUES (' .
     $valueString . ')';
     $stmt = $db->prepare($query);
     $stmt->execute($arr);
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
	  $Array[$key] = $value;
       }
    }
    $str = implode(',',$Value);
    $query = 'UPDATE ' . $table . ' SET ' . $str . ' WHERE id=' .$id;
    $stmt = $db->prepare($query);
    $stmt->execute($Array);
  }
  
  public function delete($id)  {
    $db = dbConn::getConnection();
    $table = $this->table;
    $query = 'DELETE FROM ' . $table . ' WHERE id= ' . $id;
    $stmt = $db->prepare($query);
    $stmt->execute();
    echo '<hr><h2>Row with id = ' . $id . ' deleted successfully<br></h2>';
  }

  public function getHeading()  {
    $table = $this->table;
    $query = 'SHOW COLUMNS FROM ' . $table;
    $db = dbConn::getConnection();
    $stmt = $db->prepare($query);
    $stmt->execute();
    $heading = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $heading;
    }
}

class account extends model  {
   public $id;
   public $email;
   public $fname;
   public $lname;
   public $phone;
   public $birthday;
   public $gender;
   public $password;

   public function __construct() {
      $this->table = 'accounts';
   }
}

class todo extends model  {
   public $id;
   public $owneremail;
   public $ownerid;
   public $createddate;
   public $duedate;
   public $message;
   public $isdone;

   public function __construct()
   {
       $this->table = 'todos';
   }
}
?>
