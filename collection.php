<?php


class collection {

//this is a static method so you can load all the records
    static public function findAll() {
    //get the connection with the singleton
    $db = dbConn::getConnection();
    //This sets the table for the query to the name of the static class being used to run find all
    $tableName = get_called_class();
    //this is making the select query using the name of the table
    $sql = 'SELECT * FROM ' . $tableName  ;
   //this loads the query into the statement object that will run the query
    $statement = $db->prepare($sql);
    //this runs the query
    $statement->execute();
   //this gets the name of the model from the child class that the static method was called from
    $class = static::$modelName;
   //this fetches the records as the class that is required for the record/table type
    $statement->setFetchMode(PDO::FETCH_CLASS, $class);
   //this loads the records into the record set
    $recordsSet =  $statement->fetchAll();
    return $recordsSet;
    }

    static public function deleteOne($id) {
	  $db = dbConnection::getConnection();
	  $tableName = get_called_class();
	  $sql = 'DELETE FROM ' . $tableName  . ' where id = :id';
	  try {
	     $statement = $db->prepare($sql);
	     $statement->bindParam(':id',$id);
	     $statement->execute();
	     echo 'Deleted Record Sucessfully';
	     }catch (PDOException $e){
	     echo 'Error while deleting the record';
	  }
	}
    
    static public function findOne($id) {
	  $db = dbConnection::getConnection();
	  $tableName = get_called_class();
	  $sql = 'SELECT * FROM ' . $tableName  . ' where id = :id';
	  $statement = $db->prepare($sql);
	  $statement->bindParam(':id',$id);
	  $statement->execute();
	  $class = static::$modelName;
	  $statement->setFetchMode(PDO::FETCH_CLASS, $class);
	  return  $statement->fetchAll();
    }
}
    

?>
