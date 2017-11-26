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
Displaytable::displayTable($records);


//For todos
$records = todos :: findAll();
echo '<h1> All records from todos </h1>';
Displaytable::display($records);

echo '<h1> Select from todos id=1 </h1>';
$records = accounts :: findOne(1);
Displaytable::display($records);

?>
