<?php
/**
 * CounselorAPI (Write)
 * tablename: 
 * keytable: 
 * foreignkey: 
 * foreignkeyval: 
 * primarykey: 
 * arrayofvals: 
 * conditionkey: 
 * conditionval: 
 */

/**
 * 
 */

// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}

$dbConnection = new relationalDbConnections('UserProfile', "localhost:8889", "root",

$tablename = $_GET["tablename"];
$keytable = $_GET["keytable"];
$foreignkey = $_GET["foreignkey"];
$foreignkeyval = $_GET["foreignkeyval"];
$primarykey = $_GET["primarykey"];
$arrayofvals = $_GET["arrayofvals"];
$conditionkey = $_GET["conditionkey"];
$conditionval = $_GET["conditionval"];

$dbConnection->updateTable($tablename, $keytable, $foreignkey, $foreignkeyval, $primarykey, $arrayofvals, "'$conditionkey' = '$conditionval'");

?>