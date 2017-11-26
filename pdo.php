<?php
//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);


define('DATABASE', 'nh95');
define('USERNAME', 'nh95');
define('PASSWORD', '1994apache');
define('CONNECTION', 'sql1.njit.edu');









echo '<h1> Select from account id=1 </h1>';
$records = accounts :: getById(1);
DisplayResult::displayTable($records);

echo '<h1>select all from accounts</h1>';
$records = accounts::findAll();
DisplayResult::displayTable($records);
echo '<h1> insert into todos </h1>';
todos :: insertData();


?>
