<?php

class todos extends collection {
protected static $modelName = 'todo';
  
  static public function save($todo){
  	  $conn = dbConnection::getConnection();
   	  if(isset($todo->id)){
  	    $sql = self :: getUpdateQuery();
  	  }else {
 	    $sql = self :: getInsertQuery();
  	  }
  	  try{
  	    $conn->beginTransaction();  
  	    $update = $conn -> prepare($sql);
  	    if(isset($todo->id)){
  	    	$update -> bindValue (':id', $todo->id);
  	    }
 	    $update -> bindValue(':owneremail', $todo->owneremail);
	    $update -> bindValue(':ownerid', $todo->ownerid);
	    $update -> bindValue(':createddate', $todo->createddate);
	    $update -> bindValue(':duedate', $todo->duedate);
  	  $update -> bindValue(':message', $todo->message);
	    $update -> bindValue(':isdone',$todo->isdone);
  	  $update -> execute();
 	    $lastId = $conn->lastInsertId(); 
  	    $conn-> commit();
 	    return $lastId;
  	  }
  	  catch(PDOExecption $e) {
  	  $conn->rollback();	

  	}
  
  static public function getUpdateQuery(){
  	 $tableName = get_called_class();
  	 $sql = 'UPDATE ' . $tableName. '  set  owneremail = :owneremail,ownerid = :ownerid,createddate=:createddate,duedate=:duedate,message= :message,isdone=:isdone  where id = :id';
  	 return sql;
  }
  	
  static public function getInsertQuery(){
  	$tableName = get_called_class();
    $sql = 'INSERT INTO ' . $tableName. '   (owneremail,ownerid,createddate,duedate,message,isdone) VALUES
    	   (:owneremail,:ownerid,:createddate,:duedate,:message,:isdone)';
    return sql;
  }
}


?>
