<?php

class todos extends collection {
protected static $modelName = 'todo';
  
  public static function insertData(){
        $conn = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'INSERT INTO ' . $tableName. '   (owneremail,ownerid,createddate,duedate,message,isdone) VALUES
                        (?,?,?,?,?,?)';
        try{
        $conn->beginTransaction();
        $stmt = $conn -> prepare($sql);
        $stmt->execute(array("naveen@123test",1,"2017-09-11 00:00:00","2017-09-11 00:00:00","",0));
        print $conn->lastInsertId();
        $conn-> commit();
        } catch(PDOExecption $e) {
        $conn->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
        }
   }
}


?>
