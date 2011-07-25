<?php
/**
 * College Summary Table API
 * Allows the client to access the data stored in the CollegeSummary Table
 * 
 * Parameters:
	- query: the name of the table in CollegeSummary db being requested
		values>summary,research,professors,pictures,majors,links,divsports,clubs,arts
	- id: the id of the college to get the info of
		values> all, "college_id"
	- attribute: the specific attribute of the collegeid (i.e. CollegeUrl, etc.)
		"name_of_attribute"
		values> default:all, 
	- format: The type of format to return the db contents as
		values> default:json, php, txt
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

$outputcontent = "";

// query parameter code block
switch ($query)
{
	case 'Summary' || 'summary':
		$query = "CollegeSummary";
		break;
	case 'Research' || 'research':
		$query = "CollegeResearch";
		break;
	case 'Professors' || 'professors':
		$query = "CollegeProfessors";
		break;
	case 'Pictures' || 'pictures':
		$query = "CollegePictures";
		break;
	case 'Majors' || 'majors':
		$query = "CollegeMajors";
		break;
	case 'Links' || 'links':
		$query = "CollegeLinks";
		break;
	case 'DivSports' || 'divsports' || 'Divsports':
		$query = "CollegeDivSports";
		break;
	case 'Clubs' || 'clubs':
		$query = "CollegeClubs";
		break;
	case 'Arts' || 'arts':
		$query = "CollegeArts";
		break;
	default:
		error_log("Invalid parameter for query.");
		//print 'The query parameter could not be recognized. Please check that you are using a permitted value.'
		return false;
		break;
}
$resourceid;
$resourceid2;
switch ($id)
{
	case 'all':
		$resourceid = $dbConnection->selectFromTable($query, "CollegeID");
		$resourceid2 = $dbConnection->selectFromTable($query, "CollegeID");
		break;
	case empty($id): // null case
		error_log("The parameter id has not been specified.");
		return false;
		break;
	default: // assumes id is set to the specific id of the college
		$resourceid = $dbConnection->selectFromTable($query, "CollegeID", $id);
		$resourceid2 = $dbConnection->selectFromTable($query, "CollegeID", $id);
		break;
}
if (!empty($attribute))
{
	if ($attribute == "CollegeID")
		$array = $dbConnection->formatQueryResults($resourceid, $attribute);
	else
	{
		$array = $dbConnection->formatQueryResults($resourceid, $attribute);
		$array2 = $dbConnection->formatQueryResults($resourceid2, "CollegeID");
	}
	if (is_null($array[0])) // can't destinguish between null value in table and invalid attribute parameter (both return array with single, null element)
	{
		error_log("This attribute is null for the query and id you have specified.");
		print 'NULL VALUE OR INVALID ATTRIBUTE';
		//error_log("The attribute parameter is invalid.");
		return false;
	}
	$array = array_merge($array, $array2);
}
else
{
	$array = $dbConnection->formatQueryResults($resourceid);
}

$outputcontent = $array;

//print_r($outputcontent[0]); // testing purposes only, without formatting

switch ($format)
{
	case 'json':
		$outputcontent = json_encode($outputcontent);
		break;
	case 'php':
		$outputcontent = serialize($outputcontent);
		break;
	//case 'txt':
	//	break;
	default:
		error_log("Invalid parameter for format.");
		return false;
		break;
}
print_r($outputcontent);

?>