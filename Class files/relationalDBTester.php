<?PHP
// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}

$relation = new relationalDbConnections('lala', 'localhost:8889', 'root', 'root');

$array = array("CollegePicture" => "", "CollegeID" => "");

/**
 * Example usage of InsertIntoTable. Property1: is the Table You are updating, Property2, the place you are checking for your PrimaryID
 * 			Property3 is the Column You are checking exists, Property4 is the CollegeName, Property5 is the primaryKey,
 * 			$array is the array of IDs for the insertion.
 */
$relation->insertIntoTable("CollegePictures","CollegeSummary", "CollegeName", "Stanford_University", "CollegeID", $array);

?>