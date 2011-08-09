<?php
/**
 * CounselorAPI (Write)
 * tablename: 
 * keytable: 
 * foreignkey: 
 * foreignkeyval: 
 * primarykey: 
 * field: 
 * contentoffield:
 * conditionkey: 
 * conditionval: 
 */

/**
 * MANUAL TEST CASES:
	- http://localhost:8888/counselorWriteAPI.php?tablename=StudentUsers&keytable=StudentUsers&foreignkey=StudentFirstName&foreignkeyval=Ron_Weasley&primarykey=StudentID&arrayofvals=John_Weasley&conditionkey=StudentFirstName&conditionval=Ron_Weasley
	- http://localhost:8888/counselorWriteAPI.php?tablename=StudentUsers&keytable=StudentUsers&foreignkey=StudentFirstName&foreignkeyval=Harry&primarykey=StudentID&field=StudentName&contentoffield=John&conditionkey=StudentFirstName&conditionval=Harry
	- http://localhost:8888/counselorWriteAPI.php?tablename=StudentUsers&keytable=StudentUsers&foreignkey=StudentFirstName&foreignkeyval=James&primarykey=StudentID&field=StudentFirstName&contentoffield=John&conditionkey=StudentFirstName&conditionval=James
 */

// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}

$dbConnection = new relationalDbConnections('UserProfile', "localhost:8889", "root", "root");

$tablename = $_GET["tablename"];
$keytable = $_GET["keytable"];
$foreignkey = $_GET["foreignkey"];
$foreignkeyval = $_GET["foreignkeyval"];
$primarykey = $_GET["primarykey"];
$field = $_GET["field"];
$contentoffield = $_GET["contentoffield"];
$conditionkey = $_GET["conditionkey"];
$conditionval = $_GET["conditionval"];

// checks for empty parameters, all must be specified
if (empty($tablename))
{
	error_log("The tablename has not been specified.");
	print 'TABLENAME NOT SPECIFIED';
	return false;
}
else if (empty($keytable))
{
	error_log("The keytable has not been specified.");
	print 'KEYTABLE NOT SPECIFIED';
	return false;
}
else if (empty($foreignkey))
{
	error_log("The foreignkey has not been specified.");
	print 'FOREIGNKEY NOT SPECIFIED';
	return false;
}
else if (empty($foreignkeyval))
{
	error_log("The foreignkeyval has not been specified.");
	print 'FOREIGNKEYVAL NOT SPECIFIED';
	return false;
}
else if (empty($primarykey))
{
	error_log("The primarykey has not been specified.");
	print 'PRIMARYKEY NOT SPECIFIED';
	return false;
}
else if (empty($field))
{
	error_log("The field has not been specified.");
	print 'ARRAYOFVALS NOT SPECIFIED';
	return false;
}
else if (empty($contentoffield))
{
	error_log("The contentoffield has not been specified.");
	print 'ARRAYOFVALS NOT SPECIFIED';
	return false;
}

else if (empty($conditionkey))
{
	error_log("The conditionkey has not been specified.");
	print 'CONDITIONKEY NOT SPECIFIED';
	return false;
}
else if (empty($conditionval))
{
	error_log("The conditionval has not been specified.");
	print 'CONDITIONVAL NOT SPECIFIED';
	return false;
}


$array = array("$field" => "$contentoffield");
print_r($array);

$dbConnection->updateTable($tablename, $keytable, $foreignkey, $foreignkeyval, $primarykey, $array, "$conditionkey = '$conditionval'");

?>