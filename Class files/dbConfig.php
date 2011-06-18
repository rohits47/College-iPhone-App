<?PHP
// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}

/**
 * Versioning
 * Currently versioning will be done by a variable that will be manually set. Eventually it will just update a database.properties table
 * on each person's local.
 * 
 * Before running this script, make sure to up the version number by 1 (or to the latest version (located at the bottom));
 */
$version = 1;
$databaseName = "";
$dbhost = "";
$dbuser = "";
$dbpass = "";


if($version == 1) {
	$dbConfig = new databaseProperties($databaseName, $dbhost, $dbuser, $dbpass);
	$array1 = array();

	$array1[0] = array("CollegeID", "int", "NOT NULL", "AUTO_INCREMENT");

	$array1[1] = array("PRIMARY KEY(CollegeID)", "");
	$array1[2] = array("CollegeName", "TEXT");
	$array1[3] = array("CollegeUrl", "TEXT");
	$array1[4] = array("CollegeAvgGPA", "FLOAT(9, 8)");
	$array1[5] = array("College50SAT", "INT");
	$array1[6] = array("College75SAT", "INT");
	$array1[7] = array("College25SAT", "INT");
	$array1[8] = array("CollegeAPCredit", "TINYTEXT");

	if($dbConfig->createINNODBTable("CollegeSummary", $array1)) echo "Success! Your CollegeSummary Table is now set up! <br />";
//print_r($dbConfig->createINNODBTable("CollegeSummary", $array1));
//The Next Table's set up file.
// The CollegeProfessors table.

	$array = array();
	$array[0] = array("ProfessorID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array[1] = array("PRIMARY KEY(ProfessorID)");
	$array[2] = array("CollegeProfessor", "TEXT");
	$array[3] = array("CollegeID", "INT");

	if($dbConfig->createINNODBTable("CollegeProfessors", $array)) echo "Success! Your CollegeProfessor Table is now set up! <br />";
//print_r($dbConfig->createINNODBTable("CollegeProfessors", $array));


	if($dbConfig->setRelation("CollegeProfessors", "CollegeSummary", "CollegeID")) echo "Success! Your CollegeProfessors and CollegeSummary tables have been linked via CollegeID.<br />";
}
?>