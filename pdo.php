<?php
//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);


define('DATABASE', 'nh95');
define('USERNAME', 'nh95');
define('PASSWORD', '1994apache');
define('CONNECTION', 'sql1.njit.edu');

//turn on debugging messages
ini_set('display_errors', 'true');
error_reporting(E_ALL);
//instantiate the program object
//Class to load classes it finds the file when the progrm starts to fail for calling a missing class
class Manage {
    public static function autoload($class) {
                //you can put any file name or directory here
	include strtolower($class) . '.php';
	}			 	
}
spl_autoload_register(array('Manage', 'autoload'));

//For Accounts
$records = accounts :: findAll();
echo '<h1> All records from accounts </h1>';
Displaytable::display($records);

echo '<h1> Select from account id=1 </h1>';
$records = accounts :: findOne(1);
Displaytable::display($records);

echo '<h1>Updating record in accounts<h1>';
$account = new account();
$account->id = 1;
$account->email="update@njit.edu";
$account->fname="Naveen";
$account->lname="Hottigimath";
$account->phone="1234656565";
$account->birthday="09-13-1995";
$account->gender="male";
$account->password="4564";
$account->save();
echo 'Record Updated Successfully' ;

$account = new account();
$account->email="nitin@njit.edu";
$account->fname="Nitin";
$account->lname="Shah";
$account->phone="22424";
$account->birthday="10-12-1994";
$account->gender="male";
$account->password="12345";
$account->save();
//Record 2
$account = new account();
$account->email="divyesh@njit.edu";
$account->fname="Divyesh";
$account->lname="Shah";
$account->phone="45646546";
$account->birthday="16-11-1993";
$account->gender="male";
$account->password="123423";
$lastId = $account->save();

$records = accounts :: findAll();
echo '<h1> After adding new records </h1>';
Displaytable::display($records);


accounts :: deleteOne($lstId);
$records = todos :: findAll();
echo '<h1> After deleting a record </h1>';
Displaytable::display($records);

//For todos
$records = todos :: findAll();
echo '<h1> All records from todos </h1>';
Displaytable::display($records);

echo '<h1> Select from todos id=1 </h1>';
$records = todos :: findOne(1);
Displaytable::display($records);

//Updating
$todo = new Todo();
$todo-> id = 1;
$todo->owneremail = 'murali@njit.edu' ;
$todo->ownerid = 4 ;
$todo->createddate = '2010-03-01 00:00:00' ;
$todo->duedate = '2010-06-01 00:00:00' ;
$todo->message = 'Murali B' ;
$todo->isdone = 0;
todos :: save($todo);


//Adding
$todo = new Todo();
$todo->owneremail = 'murali@njit.edu' ;
$todo->ownerid = 4 ;
$todo->createddate = '2010-03-01 00:00:00' ;
$todo->duedate = '2010-06-01 00:00:00' ;
$todo->message = 'Murali B' ;
$todo->isdone = 0;
todos :: save($todo);

$todo = new Todo();
$todo->owneremail = 'abid@njit.edu' ;
$todo->ownerid = 5 ;
$todo->createddate = '2011-05-01 00:00:00' ;
$todo->duedate = '2011-06-01 00:00:00' ;
$todo->message = 'Abid M' ;
$todo->isdone = 0;
$lstId = todos :: save($todo);

$records = todos :: findAll();
echo '<h1> After adding new records </h1>';
Displaytable::display($records);


todos :: deleteOne($lstId);
$records = todos :: findAll();
echo '<h1> After deleting a record </h1>';
Displaytable::display($records);


?>
