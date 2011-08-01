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
$totalVersions = 15;

for($i = $version; $i <= $totalVersions; $i++)
{
/**
 * CollegeID Table + ProfessorID Table
 */
if($i == 1) {
	$dbConfig->createDatabase("CollegeSummary");
	$dbConfig->setDb("CollegeSummary");
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
	$array1[11] = array("CollegePostGrads", "TINYTEXT");
	$array1[12] = array("CollegeAcademicStaff", "TINYTEXT");
	$array1[13] = array("CollegeEndowmentFund", "TINYTEXT");
	$array1[14] = array("CollegeType", "TINYTEXT");
	$array1[15] = array("CollegeEstablished", "INT");
	$array1[16] = array("CollegePresident", "TINYTEXT");
	$array1[17] = array("CollegeCampus", "TEXT");
	$array1[18] = array("CollegeRating", "INT");
	$array1[19] = array("CollegeRaters", "INT");
	$array1[20] = array("CollegeUnderGrads", "TINYTEXT");
	$array1[21] = array("CollegeSummary", "TEXT");

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
if($i == 7)
{
	$array1 = array();
	$array1[0] = array("ArtID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array1[1] = array("PRIMARY KEY(ArtID)");
	$array1[2] = array("CollegeArt", "TEXT");
	$array1[3] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("CollegeArts", $array1)) echo "Success! Your CollegeArts Table is now set up! <br />";
	
	if($dbConfig->setRelation("CollegeArts", "CollegeSummary", "CollegeID")) echo "Success! Your CollegeArts and CollegeSummary Table are now linked via CollegeID! <br />";
}
/**
 * The Profile Tables are added here....
 * Huge additions, See google doc on What's Left for details on table specifications.
 */
if($i == 8)
{
	$dbConfig->createDatabase("UserProfile");
}
if($i == 9)
{
	$dbConfig->setDb("UserProfile");
	$array = array();
	$array[0] = array("StudentID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array[1] = array("PRIMARY KEY(StudentID)");
	$array[2] = array("StudentFirstName", "TINYTEXT");
	$array[3] = array("StudentLastName", "TINYTEXT");
	$array[4] = array("StudentGPA", "DOUBLE");
	$array[5] = array("StudentSATMath", "INT");
	$array[6] = array("StudentSATWriting", "INT");
	$array[7] = array("StudentSATCR", "INT");
	$array[8] = array("StudentMajor", "TINYTEXT");
	$array[9] = array("StudentSATII1", "INT");
	$array[10] = array("StudentSATII2", "INT");
	$array[11] = array("StudentSATII3", "INT");
	$array[12] = array("StudentSchool", "TINYTEXT");
	//NOTE: Not sure if this one is needed.
	$array[13] = array("CounselorName", "TINYTEXT");
	
	if($dbConfig->createINNODBTable("StudentUsers", $array)) echo "Success! Your StudentUsers Table is now set up! <br />";

}

if($i == 10)
{	
	$array = array();
	$array[0] = array("CounselorID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array[1] = array("PRIMARY KEY(CounselorID)");
	$array[2] = array("CounselorName", "TINYTEXT");
	$array[3] = array("CounselorSchoolName", "INT");
	$array[4] = array("CounselorUsername", "TINYTEXT");
	$array[5] = array("CounselorPassword", "TINYTEXT");
	$array[6] = array("CounselorSecretKey", "TINYTEXT");
	
	if($dbConfig->createINNODBTable("CounselorUsers", $array)) echo "Success! Your CounselorUsers Table is now set up! <br />";
	
	$array1 = array();
	$array1[0] = array("ListID", "INT", "NOT NULL", "AUTO_INCREMENT");
	$array1[1] = array("PRIMARY KEY(ListID)");
	$array1[2] = array("StudentListStudentFirstName", "TINYTEXT");
	$array1[3] = array("StudentListStudentLastName", "TINYTEXT");
	$array1[4] = array("StudentID", "INT");
	$array1[5] = array("CounselorID", "INT");
	
	if($dbConfig->createINNODBTable("CounselorStudents", $array1)) echo "Success! Your CounselorStudents Table is now set up! <br />";
	
	if($dbConfig->setRelation("CounselorStudents", "StudentUsers", "StudentID")) echo "Success! Your CounselorStudents and StudentUsers Table are now linked via StudentID! <br />";

	if($dbConfig->setRelation("CounselorStudents", "CounselorUsers", "CounselorID")) echo "Success! Your CounselorStudents and CounselorUsers Table are now linked via CounselorID! <br />";
}

if($i == 11)
{
	$array = array();
	$array[0] = array("CommentID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array[1] = array("PRIMARY KEY(CommentID)");
	$array[2] = array("CommentContent", "TEXT");
	$array[3] = array("StudentID", "INT");
	$array[4] = array("CounselorID", "INT");
	$array[5] = array("CommentTagID", "INT");
	$array[6] = array("CommentTagTable", "TINYTEXT");
	
	if($dbConfig->createINNODBTable("StudentComments", $array)) echo "Success! Your StudentComments Table is now set up! <br />";
	
	if($dbConfig->setRelation("StudentComments", "StudentUsers", "StudentID")) echo "Success! Your StudentComments and StudentUsers Table are now linked via StudentID! <br />";
	
	if($dbConfig->setRelation("StudentComments", "CounselorUsers", "CounselorID")) echo "Success! Your StudentComments and CounselorUser Tables are now linked via CounselorID";

}
if($i == 12)
{
	$array = array();
	$array[0] = array("RecommendedID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array[1] = array("PRIMARY KEY(RecommendedID)");
	$array[2] = array("RecommendedName", "TINYTEXT");
	$array[3] = array("StudentID", "INT");
	$array[4] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("StudentRecommended", $array)) echo "Success! Your StudentRecommended Table is now set up! <br />";
	
	if($dbConfig->setRelation("StudentRecommended", "StudentUsers", "StudentID")) echo "Success! Your StudentRecommended and StudentUsers Table are now linked via StudentID! <br />";
	
	if($dbConfig->setRelation("StudentRecommended", "CollegeSummary", "CollegeID", "CollegeSummary")) echo "Success! Your StudentRecommended and CollegeSummary Table are now linked via CollegeID! <br />";
	
}

if($i == 13)
{
	$array = array();
	$array[0] = array("SCollegeID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array[1] = array("PRIMARY KEY(SCollegeID)");
	$array[2] = array("SCollegeName", "TINYTEXT");
	$array[3] = array("StudentID", "INT");
	$array[4] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("StudentColleges", $array)) echo "Success! Your StudentColleges Table is now set up! <br />";
	
	if($dbConfig->setRelation("StudentColleges", "StudentUsers", "StudentID")) echo "Success! Your StudentColleges and StudentUsers Table are now linked via StudentID! <br />";
	
	if($dbConfig->setRelation("StudentColleges", "CollegeSummary", "CollegeID", "CollegeSummary")) echo "Success! Your StudentColleges and CollegeSummary Table are now linked via CollegeID! <br />";
	
}
if($i == 14)
{
	$array = array();
	$array[0] = array("NoteID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array[1] = array("PRIMARY KEY(NoteID)");
	$array[2] = array("NoteContent", "TEXT");
	$array[3] = array("StudentID", "INT");
	$array[4] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("StudentNotes", $array)) echo "Success! Your StudentNotes Table is now set up! <br />";
	
	if($dbConfig->setRelation("StudentNotes", "StudentUsers", "StudentID")) echo "Success! Your StudentNotes and StudentUsers Table are now linked via StudentID! <br />";
	
	if($dbConfig->setRelation("StudentNotes", "CollegeSummary", "CollegeID", "CollegeSummary")) echo "Success! Your StudentNotes and CollegeSummary Table are now linked via CollegeID! <br />";
}

if($i == 15)
{
	//This covers the Tours Tables
	$array = array();
	$array[0] = array("TourID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array[1] = array("PRIMARY KEY(TourID)");
	$array[2] = array("StudentID", "INT");
	
	if($dbConfig->createINNODBTable("StudentTours", $array)) echo "Success! Your StudentTours Table is now set up! <br />";
	
	if($dbConfig->setRelation("StudentTours", "StudentUsers", "StudentID")) echo "Success! Your StudentTours and StudentUsers Table are now linked via StudentID! <br />";	
	
	$array1 = array();
	$array1[0] = array("HitListID", "int", "NOT NULL", "AUTO_INCREMENT");
	$array1[1] = array("PRIMARY KEY(HitListID)");
	$array1[2] = array("TourID", "INT");
	$array1[3] = array("TourCollegeName", "TINYTEXT");
	$array1[4] = array("CollegeID", "INT");
	
	if($dbConfig->createINNODBTable("ToursHitList", $array1)) echo "Success! Your ToursHitList Table is now set up! <br />";
	
	if($dbConfig->setRelation("ToursHitList", "CollegeSummary", "CollegeID", "CollegeSummary")) echo "Success! Your ToursHitList and CollegeSummary Table are now linked via CollegeID! <br />";

	if($dbConfig->setRelation("ToursHitList", "StudentTours", "ToursID")) echo "Success! Your ToursHitList and StudentTours Table are now linked via ToursID! <br />";
	
}

}
?>