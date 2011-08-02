<?php
/**
 * CounselorAPI (Read)
 */

/**
 * MANUAL TEST CASES:
	- http://localhost:8888/counselorReadAPI.php?query=counselorusers&id=1&attribute=CounselorName
		result: working (returns counselor name for counselorid 1)
	- http://localhost:8888/counselorReadAPI.php?query=counselorusers&columnforid=CounselorSchoolName&id=22&attribute=CounselorName
		result: working (returns counselor name for CounselorSchoolName with value 22)
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
$columnforid = $_GET["columnforid"];
$id = $_GET["id"];
$attribute = $_GET["attribute"];

$query = strtolower($query); // lowercases the query, makes it easier for case statements
switch ($query)
{
	case 'counselorstudents':
		$query = "CounselorStudents";
		if (empty($columnforid))
		{
			$columnforid = "ListID";
		}
		break;
	case 'counselorusers':
		$query = "CounselorUsers";
		if (empty($columnforid))
		{
			$columnforid = "CounselorID";
		}
		break;
	case 'studentcolleges':
		$query = "StudentColleges";
		if (empty($columnforid))
		{
			$columnforid = "SCollegeID";
		}
		break;
	case 'studentcomments':
		$query = "StudentComments";
		if (empty($columnforid))
		{
			$columnforid = "CommentID";
		}
		break;
	case 'studentnotes':
		$query = "StudentNotes";
		if (empty($columnforid))
		{
			$columnforid = "NoteID";
		}
		break;
	case 'studentrecommended':
		$query = "StudentRecommended";
		if (empty($columnforid))
		{
			$columnforid = "RecommendedID";
		}
		break;
	case 'studenttours':
		$query = "StudentTours";
		if (empty($columnforid))
		{
			$columnforid = "TourID";
		}
		break;
	case 'studentusers':
		$query = "StudentUsers";
		if (empty($columnforid))
		{
			$columnforid = "StudentID";
		}
		break;
	case 'tourshitlist':
		$query = "ToursHitList";
		if (empty($columnforid))
		{
			$columnforid = "HitListID";
		}
		break;
	default:
		error_log("The specified query was invalid.");
		print 'INVALID QUERY';
		return false;
		break;
}

$resourceid;
switch ($id)
{
	case 'all': // case may not be necessary, included just in case
		$resourceid = $dbConnection->selectFromTable($query);
		break;
	default: // assumes id is set to the specific id of the student/counselor
		$resourceid = $dbConnection->selectFromTable($query, $columnforid, $id);
		break;
}

$array;
if (!empty($attribute))
{
	$array = $dbConnection->formatQueryResults($resourceid, $attribute);
	if (is_null($array[0])) // NOTE: can't destinguish between null value in table and invalid attribute parameter (both return array with single, null element)
	{
		error_log("This attribute is null for the query and id you have specified.");
		print 'NULL VALUE OR INVALID ATTRIBUTE';
		return false;
	}
}
else // attribute is unspecified, gets data for all attributes
{
	$array = $dbConnection->formatQueryResults($resourceid);
}

$outputcontent = $array;
$outputcontent = json_encode($outputcontent);
echo $outputcontent;

?>