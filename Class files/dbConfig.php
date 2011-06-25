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
 * The Variables $dbhost, $databaseName, $dbuser, $dbpass need to be filled with your local settings.
 * 
 * If you are more than one version number behind, set it to the version right after the one you got before. If you already have 2, set it 
 * to 3 (for example!). This will trigger the for() loop which should add all the updates for you till the most recent version number.
 * 
 * Before running this script, make sure to up the version number by 1 (or to the latest version (located at the bottom));
 */
$version = 1;
$databaseName = "lala";
$dbhost = "localhost:8889";
$dbuser = "root";
$dbpass = "root";


//Do NOT EDIT THIS PORTION OF THE CODE.
$dbConfig = new databaseProperties($databaseName, $dbhost, $dbuser, $dbpass);
$totalVersions = 6;

for($i = $version; $i <= $totalVersions; $i++)
{
/**
 * CollegeID Table + ProfessorID Table
 */
if($i == 1) {
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
	$array1[9] = array("CollegeLocation", "TEXT");
	$array1[10] = array("CollegeAthletics", "Text");
	$array1[11] = array("CollegePostGrads", "INT");
	$array1[12] = array("CollegeAcademicStaff", "INT");
	$array1[13] = array("CollegeEndowmentFund", "INT");
	$array1[14] = array("CollegeType", "TINYTEXT");
	$array1[15] = array("CollegeEstablished", "INT");
	$array1[16] = array("CollegePresident", "TINYTEXT");
	$array1[17] = array("CollegeCampus", "TEXT");

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

/**
 * PictureID Table
 */
if($i == 2)
{
	$array = array();
	$array[0] = array("PictureID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array[1] = array("PRIMARY KEY(PictureID)");
	$array[2] = array("CollegePicture", "TEXT");
	$array[3] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("CollegePictures", $array)) echo "Success! Your CollegePictures Table is now set up! <br />";
	
	if($dbConfig->setRelation("CollegePictures", "CollegeSummary", "CollegeID")) echo "Success! Your CollegePictures and CollegeSummary Table are now linked via CollegeID! <br />";

}

/**
 * LinkIDTable + ResearchID Table
 */
if($i == 3)
{	
	$array1 = array();
	$array1[0] = array("LinkID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array1[1] = array("PRIMARY KEY(LinkID)");
	$array1[2] = array("CollegeLink", "TEXT");
	$array1[3] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("CollegeLinks", $array1)) echo "Success! Your CollegeLinks Table is now set up! <br />";
	
	if($dbConfig->setRelation("CollegeLinks", "CollegeSummary", "CollegeID")) echo "Success! Your CollegeLinks and CollegeSummary Table are now linked via CollegeID! <br />";
	
	$array2 = array();
	$array2[0] = array("ResearchID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array2[1] = array("PRIMARY KEY(ResearchID)");
	$array2[2] = array("CollegeResearch", "TEXT");
	$array2[3] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("CollegeResearch", $array2)) echo "Success! Your CollegeResearch Table is now set up! <br />";
	
	if($dbConfig->setRelation("CollegeResearch", "CollegeSummary", "CollegeID")) echo "Success! Your CollegeResearch and CollegeSummary Table are now linked via CollegeID! <br />";
	
}
/**
 * DivSports Table + Majors Table
 */
if($i == 4)
{
	$array = array();
	$array[0] = array("DivSportID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array[1] = array("PRIMARY KEY(DivSportID)");
	$array[2] = array("CollegeDivSports", "TEXT");
	$array[3] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("CollegeDivSports", $array)) echo "Success! Your CollegeDivSports Table is now set up! <br />";
	
	if($dbConfig->setRelation("CollegeDivSports", "CollegeSummary", "CollegeID")) echo "Success! Your CollegeDivSports and CollegeSummary Table are now linked via CollegeID! <br />";
	
	$array1 = array();
	$array1[0] = array("MajorID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array1[1] = array("PRIMARY KEY(MajorID)");
	$array1[2] = array("CollegeMajor", "Text");
	$array1[3] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("CollegeMajors", $array1)) echo "Success! Your CollegeMajors Table is now set up! <br />";
	
	if($dbConfig->setRelation("CollegeMajors", "CollegeSummary", "CollegeID")) echo "Success! Your CollegeMajors and CollegeSummary Table are now linked via CollegeID! <br />";
}

if($i == 5)
{
	if($dbConfig->dropTable("CollegeLinks")) echo "Success! CollegeLinks Table has been dropped <br />";
	
	$array1 = array();
	$array1[0] = array("LinkID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array1[1] = array("PRIMARY KEY(LinkID)");
	$array1[2] = array("CollegeLink", "TEXT");
	$array1[3] = array("CollegeTag", "TINYTEXT");
	$array1[4] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("CollegeLinks", $array1)) echo "Success! Your CollegeLinks Table is now set up! <br />";
	
	if($dbConfig->setRelation("CollegeLinks", "CollegeSummary", "CollegeID")) echo "Success! Your CollegeLinks and CollegeSummary Table are now linked via CollegeID! <br />";
	
}

if($i == 6)
{
	$array1 = array();
	$array1[0] = array("ClubID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array1[1] = array("PRIMARY KEY(ClubID)");
	$array1[2] = array("CollegeClub", "TEXT");
	$array1[3] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("CollegeClubs", $array1)) echo "Success! Your CollegeClubs Table is now set up! <br />";
	
	if($dbConfig->setRelation("CollegeClubs", "CollegeSummary", "CollegeID")) echo "Success! Your CollegeClubs and CollegeSummary Table are now linked via CollegeID! <br />";
}

}
?>