<?php
/**
 * Ratings API
 * Allows the client access to read and write to the ratings portion of the College Summary Table.
 * 
 * Parameters:
	- query: the type of request being made.
		default: prints/logs error
		values>avg(calls getAverage),update(calls updateRatings), add(calls addToRatings)
	- id: the id of the college to get/set ratings.
		values>"college_id"
	- oldRating: if calling updateRatings, gives the old user rating as well as the newRating
		default: prints/logs error
		values> 1, 2, 3, 4, 5
	- newRating: the users rating on the college
		default: prints/logs error
		values> 1, 2, 3, 4, 5
 */

/**
 * MANUAL TEST CASES:
	- http://localhost:8888/ratingsAPI.php?query=add&id=8&newRating=2
		result: CollegeRaters set to 1 for college with id 8 and CollegeRating set to 2.
	- http://localhost:8888/ratingsAPI.php?query=update&id=8&newRating=4
		result: NO OLDRATING SPECIFIED.
	- http://localhost:8888/ratingsAPI.php?query=update&id=8&newRating=4&oldRating=2
		result: CollegeRating for college with id 8 is changed to 4.
	- http://localhost:8888/ratingsAPI.php?query=avg&id=8
		result: prints out "4" to the web page.
	- http://localhost:8888/ratingsAPI.php?query=avg&id=10
		result: "There are not enough ratings to show an average rating for this college." is printed out to the web page.
 */


// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main page.
function __autoload($class)
{
	require_once $class . '.php';
}

// change dbConnection parameters to reflect active MySQL setup.
$dbConnection = new relationalDbConnections('lala', "localhost:8889", "root", "root");
$ratings = new ratings($dbConnection); // instance of ratings class with which to write and read to db.

$query = $_GET["query"];
$id = $_GET["id"];
$oldRating = $_GET["oldRating"];
$newRating = $_GET["newRating"];

$outputcontent = "";

if (empty($id))
{
	error_log("Please specify the id parameter.");
	print 'ID NOT SPECIFIED.';
	return false;
}

switch ($query)
{
	case 'avg': // the average rating will be printed to the page
		$outputcontent = $ratings->getAverageRating($id);
		if ($outputcontent === 0)
		{
			$outputcontent = "There are not enough ratings to show an average rating for this college.";
		}
		break;
	case 'add':
		if (empty($newRating))
		{
			error_log("If you wish to add a new rating, please specify a newRating in the parameters.");
			print 'NO NEWRATING SPECIFIED.';
			return false;
		}
		else // $id and $newRating have been checked and are valid by this point.
		{
			$ratings->addToRatings($id, $newRating);
			print 'Success!';
		}
		break;
	case 'update':
		if (empty($oldRating))
		{
			error_log("If you wish to update a previous rating, please specify an oldRating in the parameters.");
			print 'NO OLDRATING SPECIFIED.';
			return false;
		}
		else if (empty($newRating))
		{
			error_log("If you wish to update a previous rating, please specify a newRating in the parameters.");
			print 'NO NEWRATING SPECIFIED.';
			return false;
		}
		else // $id, $oldRating, and $newRating have all been checked and are valid by this point.
		{
			$ratings->updateRatings($id, $oldRating, $newRating);
			print 'Success!';
		}
		break;
	default:
		error_log("Invalid value for the query parameter.");
		print 'INVALID QUERY';
		return false;
		break;
}

if (!empty($outputcontent))
{
	echo $outputcontent;
}

?>