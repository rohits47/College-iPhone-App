<?php
/**
 * College Summary Table API
 * Allows the client to access the data stored in the CollegeSummary Table
 * 
 * Parameters:
	- query: the name of the field in CollegeSummary table being requested
		"tablename"
	- id: the id of the college to get the info of
		values> all, "college_id"
	- attribute: the specific attribute of the collegeid (i.e. collegeurl, etc.)
		values> default:all, "name_of_attribute"
	- format: The type of format to return the db contents as
		values> json, php, txt
 */

// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}

$dbConnection = new relationalDbConnections('lala', "localhost:8889", "root", "root");

$query = $_GET["query"];
$id = $_GET["id"];
$attribute = $_GET["attribute"];
$format = $_GET["format"];


?>