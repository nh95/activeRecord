<?php
class accounts extends collection {
    protected static $modelName = 'account';
  }

 static public function save($account){
  	  $conn = dbConn::getConnection();
   	  if(isset($account->id)){
  	    $sql = self :: getUpdateQuery();
  	  }else {
 	    $sql = self :: getInsertQuery();
  	  }
  	  try{
  	    $conn->beginTransaction();  
  	    $update = $conn -> prepare($sql);
  	    if(isset($account->id)){
  	    	$update -> bindValue (':id', $account->id);
  	    }
 	    $update -> bindValue(':email', $account->email);
	    $update -> bindValue(':fname', $account->fname);
	    $update -> bindValue(':lname', $account->lname);
	    $update -> bindValue(':phone', $account->phone);
  	  $update -> bindValue(':birthday', $account->birthday);
	    $update -> bindValue(':gender',$account->gender);
          $update -> bindValue(':password',$account->password);
  	  $update -> execute();
 	    $lastId = $conn->lastInsertId(); 
  	    $conn-> commit();
 	    return $lastId;
  	  }
  	  catch(PDOExecption $e) {
  	  $conn->rollback();	
  	}
    }
  
  static public function getUpdateQuery(){
  	 $tableName = get_called_class();
  	 $sql = 'UPDATE ' . $tableName. '  set  email = :email,fname = :fname,lname=:lname,phone=:phone,
     birthday= :birthday,gender=:gender,password = :password  where id = :id';
  	 return $sql;
  }
  	
  static public function getInsertQuery(){
  	$tableName = get_called_class();
    $sql = 'INSERT INTO ' . $tableName. '   (email,fname,lname,phone,birthday,gender,password) VALUES
    	   (:email,:fname,:lname,:phone,:birthday,:gender,:password)';
    return $sql;
  }
}
?>
