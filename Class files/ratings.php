<?PHP
/**
 * Ratings class
 *
 * @package default
 * @author Abhinav  Khanna
 **/
class ratings
{
	
	public static function getAverageRating($college)
	{
		$dbConnection = new relationalDbConnections('collegeSummary', "localhost", "root", "");
		$id = $dbConnection->selectFromTable("CollegeSummary", "CollegeName", $college) // value?
		$totalRatingArray = $dbConnection->formatQueryResults($id, "CollegeRating");
		$totalRating = $totalRatingArray[0];
		$totalRaterArray = $dbConnection->formatQueryResults($id, "CollegeRaters");
		$totalRaters = $totalRaterArray[0];
		$avgRating = $totalRating/$totalRaters;
		return $avgRating;
	}
	
	public static function updateRatings($college, $newRating, )
	{
		$dbConnection = new relationalDbConnections('collegeSummary', "localhost", "root", "");
		$id = $dbConnection->selectFromTable("CollegeSummary", "CollegeName", $college) // value?
		$totalRatingArray = $dbConnection->formatQueryResults($id, "CollegeRating");
		$totalRating = $totalRatingArray[0];
		$totalRaterArray = $dbConnection->formatQueryResults($id, "CollegeRaters");
		$totalRaters = $totalRaterArray[0];
		// update ints appropriately
//		$totalRaters = $totalRaters + 1;
//		$totalRating = $totalRating - 5;
		$totalRating = $totalRating + $newRating; // runs regardless of first time
		$newRatingArray = array( "CollegeRating" => $totalRating );
		$newRatersArray = array( "CollegeRaters" => $totalRaters );
		$dbConnection->updateTable("CollegeSummary","CollegeSummary", "CollegeName", $college, "CollegeID", $newRatingArray, "CollegeName = $college");
		$dbConnection->updateTable("CollegeSummary","CollegeSummary", "CollegeName", $college, "CollegeID", $newRatersArray, "CollegeName = $college");
	}
	
	public static function isFirst()
	{
		
	}
	
	// change depending on whether formatQueryResults returns empty array or error or null
	public static function addToRatings($college, $newRating)
	{
		$dbConnection = new relationalDbConnections('collegeSummary', "localhost", "root", "");
		$id = $dbConnection->selectFromTable("CollegeSummary", "CollegeName", $college) // value?
		$totalRatingArray = $dbConnection->formatQueryResults($id, "CollegeRating");
		$totalRating = $totalRatingArray[0]; // check 0 during testing
		//newidforrater
		$totalRaterArray = $dbConnection->formatQueryResults($id, "CollegeRaters");
		$totalRaters = $totalRaterArray[0];
		// update ints appropriately
		$totalRaters = $totalRaters + 1;
//		$totalRating = $totalRating - 5;
		$totalRating = $totalRating + $newRating; // runs regardless of first time
		$newRatingArray = array( "CollegeRating" => $totalRating );
		$newRatersArray = array( "CollegeRaters" => $totalRaters );
		$dbConnection->updateTable("CollegeSummary","CollegeSummary", "CollegeName", $college, "CollegeID", $newRatingArray, "CollegeName = $college");
		$dbConnection->updateTable("CollegeSummary","CollegeSummary", "CollegeName", $college, "CollegeID", $newRatersArray, "CollegeName = $college");
	}
} // END class 