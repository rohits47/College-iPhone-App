<?php
// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}

$baseurl = "http://localhost.com:8888/CSAPI.php?"
$queryArr = array("CollegeSummary", "CollegeResearch", "CollegeProfessors", "CollegePictures", "CollegeMajors", "CollegeLinks", "CollegeDivSports", "CollegeClubs", "CollegeArts");
$id = "all";
$attribute = 
$format = 

$url = $baseurl . "query=" . $query . "&id=" . $id . "&format=" . $format; // query and id must be specified
if (!empty($attribute))
	$url = $url . "&attribute=" . $attribute;
	
?>