<?PHP
/**
 * Ratings class
 *
 * @package default
 * @author Abhinav  Khanna
 **/
class ratings
{
	// protected fields here
	protected $_dbConnection;
	protected $_connection;
	
	public function __construct($dbConnection)
	{
		$this->_dbConnection = $dbConnection;
		$this->_connection = $this->_dbConnection->open_db_connection();
	}
	
	
/*	public  function getAverageRating($college)
	{
		$dbConnection = new relationalDbConnections('lala', 'localhost:3306', 'root', 'root');
		$id = $dbConnection->selectFromTable("CollegeSummary", "CollegeName", $college)
		$totalRatingArray = $dbConnection->formatQueryResults($id, "CollegeRating");
		$totalRating = $totalRatingArray[0];
		$totalRaterArray = $dbConnection->formatQueryResults($id, "CollegeRaters");
		$totalRaters = $totalRaterArray[0];
		$avgRating = $totalRating/$totalRaters;
		return $avgRating;
	}
*/	
/*	public  function updateRatings($college, $newRating, $oldRating)
	{
		$dbConnection = new relationalDbConnections('lala', 'localhost:3306', 'root', 'root');
		$id = $dbConnection->selectFromTable("CollegeSummary", "CollegeName", $college) // value?
		$totalRatingArray = $dbConnection->formatQueryResults($id, "CollegeRating");
		$totalRating = $totalRatingArray[0];
		$id2 = $dbConnection->selectFromTable("CollegeSummary", "CollegeName", $college)
		$totalRaterArray = $dbConnection->formatQueryResults($id2, "CollegeRaters");
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
*/
	/**
     * returns
     */
	public function isFirst($college)
	{
		$id = $this->_dbConnection->selectFromTable("CollegeSummary", "CollegeName", "$college");
		$totalRatingArray = $this->_dbConnection->formatQueryResults($id, "CollegeRating");
		$totalRating = $totalRatingArray[0];
		if ( is_null($totalRating) || $totalRating == "" ) 
		{
			return true;
		}
		else
		{
			return $totalRating;
		}
	}
	
	// change depending on whether formatQueryResults returns empty array or error or null
	/**
	 * $college:
	 * 
	 */
	public function addToRatings($college, $rating)
	{
		$first = $this->isFirst($college);
		$newTotalRating;
		$newTotalRaters;
		if ($first == true)
		{
			$newTotalRaters = 1;
			$newTotalRating = $rating;
		//	print 'if';
		//	return;
		}
		else
		{
			$newTotalRating = $rating + $first;
			$id2 = $this->_dbConnection->selectFromTable("CollegeSummary", "CollegeName", $college);
			$totalRaterArray = $this->_dbConnection->formatQueryResults($id2, "CollegeRaters");
			$oldRaters = $totalRaterArray[0];
			$newTotalRaters = $oldRaters + 1; // increments raters for this college
		}
		$newRatingArray = array( "CollegeRating" => $newTotalRating );
		$newRatersArray = array( "CollegeRaters" => $newTotalRaters );
		// pushes new ratings and users to db
		$this->_dbConnection->updateTable("CollegeSummary","CollegeSummary", "CollegeName", $college, "CollegeID", $newRatingArray, "CollegeName = '$college'");
		$this->_dbConnection->updateTable("CollegeSummary","CollegeSummary", "CollegeName", $college, "CollegeID", $newRatersArray, "CollegeName = '$college'");
	}
} // END class 