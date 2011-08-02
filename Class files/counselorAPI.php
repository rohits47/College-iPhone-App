<?php
/**
 * CounsellorAPI
 * Handles reads and writes to the database for the counsellor UI
 * query: the table to be read/written to
 *   values>names_of_tables (i.e. counselorusers //case does not matter)
 * id: the StudentID or CounselorID (depending on the call)
 *   values>id_number (i.e. 8)
 * user: which person is accessing (counselor or student)
 *   values>user(the iPhone app user), counselor(counselor via web interface)
 * attribute: the specific attribute in the table to be returned (i.e. StudentName)
 *   values> (i.e. StudentListStudentFirstName)
 * content: the content to be pushes to the specified attribute and id, if request is a get, this is empty
 *   values>content_stuff (i.e. "Safety", or other counselor comments)
 */

/**
 * MANUAL TEST CASES:
	- http://localhost:8888/counselorAPI.php?query=counselorusers&id=1&user=counselor&attribute=CounselorName&content=JohnJacob
		result: 
	- http://localhost:8888/counselorAPI.php?query=studentusers&id=1&user=student&attribute=StudentFirstName&content=JohnJacob
	- 
 */

// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}

// the connection that is used for all interaction with the db
$dbConnection = new relationalDbConnections('UserProfile', "localhost:8889", "root", "root");

$outputcontent = "";

$query = $_GET["query"];
$id = $_GET["id"];
$user = $_GET["user"];
$attribute = $_GET["attribute"];
$content = $_GET["content"]; // the content to be put into the specified attribute

if (empty($id))
{
	error_log("Please make sure the id parameter is specified.");
	print 'ID NOT SPECIFIED';
	return false;
}

if ($user == 'student')
{
	$user = "StudentID";
}
else if ($user == 'counselor')
{
	$user = "CounselorID";
}
else
{
	error_log("The user parameter is invalid.");
	print 'INVALID USER PARAMETER';
	return false;
}

$query = strtolower($query); // lowercases the query, makes it easier for case statements
switch ($query)
{
	case 'counselorstudents':
		$query = "CounselorStudents";
		break;
	case 'counselorusers':
		$query = "CounselorUsers";
		break;
	case 'studentcolleges':
		$query = "StudentColleges";
		break;
	case 'studentcomments':
		$query = "StudentComments";
		break;
	case 'studentnotes':
		$query = "StudentNotes";
		break;
	case 'studentrecommended':
		$query = "StudentRecommended";
		break;
	case 'studenttours':
		$query = "StudentTours";
		break;
	case 'studentusers':
		$query = "StudentUsers";
		break;
	case 'tourshitlist':
		$query = "ToursHitList";
		break;
	default:
		error_log("The specified query was invalid.");
		print 'INVALID QUERY';
		return false;
		break;
}

$resourceid;
$resourceid2;
switch ($id)
{
	case 'all': // case may not be necessary, included just in case
		$resourceid = $dbConnection->selectFromTable($query);
		$resourceid2 = $dbConnection->selectFromTable($query);
		break;
	default: // assumes id is set to the specific id of the student/counselor
		$resourceid = $dbConnection->selectFromTable($query, $user, $id);
		$resourceid2 = $dbConnection->selectFromTable($query, $user, $id);
		break;
}

switch ($content)
{
	case empty($content):
		if (!empty($attribute)) // means request is a get
		{
			$array = $dbConnection->formatQueryResults($resourceid, $attribute);
			if (is_null($array[0])) // NOTE: can't destinguish between null value in table and invalid attribute parameter (both return array with single, null element)
			{
				error_log("This attribute is null for the query and id you have specified.");
				print 'NULL VALUE OR INVALID ATTRIBUTE';
				return false;
			}
		}
		else // gets all attributes
		{
			$array = $dbConnection->formatQueryResults($resourceid);
		}
		break;
	default: // assumes requisite content is specified, request is a set
		$array = array($content); // puts content as first element in an array for the update table method
		//print 'here';
		if ($user == "StudentID")
		{
			$dbConnection->updateTable($query, "StudentUsers", "StudentID", $id, "StudentID", $array, "StudentID = '$id'");
			//print '1';
		}
		else
		{
			$dbConnection->updateTable($query, "CounselorUsers", "CounselorID", $id, "CounselorID", $array, "CounselorID = '$id'");
			//print '2';
		}
		break;
}

if (empty($content)) // if request is a get, prints out content
{
	$outputcontent = $array;
	$outputcontent = json_encode($outputcontent);
	echo $outputcontent;
}

?>