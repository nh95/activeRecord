<?php
//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);


define('DATABASE', 'nh95');
define('USERNAME', 'nh95');
define('PASSWORD', '1994apache');
define('CONNECTION', 'sql1.njit.edu');


class dbConn{

    //variable to hold connection object.
        protected static $db;

	//private construct - class cannot be instatiated externally.
	        private function __construct() {

		        try {
           // assign PDO object to db variable
            self::$db = new PDO( 'mysql:host=' . CONNECTION .';dbname=' . DATABASE,USERNAME, PASSWORD );
	    self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	  catch (PDOException $e) {
    //Output error - would normally log this to error file rather than output to user.
    echo "Connection Error". $e->getMessage();												            }

		 }
// get connection function. Static method - accessible without instantiation
    public static function getConnection() {

            //Guarantees single instance, if no connection object exists then create one.
	            if (!self::$db) {
		                //new connection object.
				            new dbConn();
					            }

						            //return connection.
							            return self::$db;
								        }
									}

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

}

class accounts extends collection {
    protected static $modelName = 'account';

public static  function getById($id) {
       $db = dbConn::getConnection();
       $tableName = get_called_class();
       $sql = 'SELECT * FROM ' . $tableName  . ' where id = :id';
       $stmt = $db->prepare($sql);
       $stmt->bindParam(':id',$id);
       $stmt->execute();
       $class = static::$modelName;
       $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
       return  $stmt->fetchAll();
       }
    }

class account {
public $id;
public $email;
public $fname;
public $lname;
public $phone;
public $birthday;
public $gender;
public $password;
}


class todo {
public $id;
public $ownerEmail;
public $ownerId;
public $createdDate;
public $dueDate;
public $message;
public $isDone;
}

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


class DisplayResult{


public static function displayTable($records){
$html = "<html><body><table border = 1>";
$html .= "<tr>";
//Set the header using the 1st record
foreach($records[0] as $key => $value){
$html .="<th>" .$key. "</th>";
}
$html .= "</tr>";
//generate rows
foreach($records as $record){
$html .= "<tr>";
foreach ($record as $key => $value){
$html .="<td>" .$value. "</td>";
}
$html .= "</tr>";
}
$html .="</table>";
echo $html;
}

}
echo '<h1> Select from account id=1 </h1>';
$records = accounts :: getById(1);
DisplayResult::displayTable($records);

echo '<h1>select all from accounts</h1>';
$records = accounts::findAll();
DisplayResult::displayTable($records);
echo '<h1> insert into todos </h1>';
todos :: insertData();


?>
