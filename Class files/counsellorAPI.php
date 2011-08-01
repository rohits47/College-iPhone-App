<?php
/**
 * CounsellorAPI
 * 
 */

// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}

// the connection that is used for all interaction with the db
$dbConnection = new relationalDbConnections('lala', "localhost:8889", "root", "root");

$query = $_GET["query"];

?>