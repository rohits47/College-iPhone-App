<?php
// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}

// set arrays for testing values
// set loop to iterate through those values

$baseurl = "http://localhost:8888/CSAPI.php?";

$queryArr = array("Summary", "Research", "Professors", "Pictures", "Majors", "Links", "DivSports", "Clubs", "Arts"); // all possible valid queries
$id = "99"; // 1 - 3,000 is a valid range (few numbers above 3,000 will work too)
$attribute = "CollegeName";
$formatArr = array("php", "json");

$query = $queryArr[0];
//$id = "99"; // 1 - 3,000 is a valid range (few numbers above 3,000 will work too)
$attribute = "CollegeName";
$format = $formatArr[0];

$url = $baseurl . "query=" . $query . "&id=" . $id . "&format=" . $format; // query and id MUST be specified
if (!empty($attribute)) // attribute parameter is optional
	$url = $url . "&attribute=" . $attribute;

//cURLs the api url to get page contents (output of api call)
$source = urlParser::cURL($url);
$decoded;
if ($format = "php")
	$decoded = unserialize($source);
if ($format = "json")
	$decoded = json_decode($source);

//print_r($decoded[0]);
$stringToWrite = "\n";
$stream = fopen("/csapitestoutput.txt", "x+");
fwrite($stream, $stringToWrite);
fclose($stream);

?>