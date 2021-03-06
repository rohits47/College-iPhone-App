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
	
	/**
	 * $collegeID: The college to get the average rating of.
	 * A value of 0 means no ratings exist
	 * This method returns the average rating (int) for a college from among the user ratings of the college so far. If no users have rated the college, it returns a string saying that not enough ratings exist to calculate an average.
	 */
	public function getAverageRating($collegeID)
	{
		$id = $this->_dbConnection->selectFromTable("CollegeSummary", "CollegeID", "$collegeID");
		$totalRatingArray = $this->_dbConnection->formatQueryResults($id, "CollegeRating");
		$totalRating = $totalRatingArray[0];
		$id2 = $this->_dbConnection->selectFromTable("CollegeSummary", "CollegeID", $collegeID);
		$totalRaterArray = $this->_dbConnection->formatQueryResults($id2, "CollegeRaters");
		$totalRaters = $totalRaterArray[0];
		if ($totalRating == 0 || $totalRaters == 0)
		{
			return 0;
		}
		else
		{
			$avgRating = $totalRating/$totalRaters;
			return $avgRating;
		}
	}
	
	/**
	 * $collegeID: The string name of the college being rated
	 * $rating: The rating of the college to be added to the db
	 * $oldRating: The users oldRating, that is to be replaced with the new rating
	 * Use this method when a user changes his/her rating on a college
	 */
	public function updateRatings($collegeID, $oldRating, $newRating)
	{
		$id = $this->_dbConnection->selectFromTable("CollegeSummary", "CollegeID", "$collegeID");
		$totalRatingArray = $this->_dbConnection->formatQueryResults($id, "CollegeRating");
		$totalRating = $totalRatingArray[0];
		$newTotalRating = ($totalRating - $oldRating) + $newRating;
		$newRatingArray = array( "CollegeRating" => $newTotalRating );
		// pushes new rating to db
		$this->_dbConnection->updateTable("CollegeSummary","CollegeSummary", "CollegeID", $collegeID, "CollegeID", $newRatingArray, "CollegeID = '$collegeID'");
	//	print 'successu';
	}

	/**
     * returns true if this is the college's first rating, returns the college's total rating otherwise
	 * $collegeID: The college to check the totalRating of.
     */
	public function isFirst($collegeID)
	{
		$id = $this->_dbConnection->selectFromTable("CollegeSummary", "CollegeID", "$collegeID");
		$totalRatingArray = $this->_dbConnection->formatQueryResults($id, "CollegeRating");
		$totalRating = $totalRatingArray[0];
		if ( is_null($totalRating) || $totalRating == "" ) 
		{
			return true; // this means first time that this college is being rated
		}
		else
		{
			return $totalRating;
		}
	}
	
	/**
	 * $collegeID: The string name of the college being rated
	 * $rating: The rating of the college to be added to the db
	 * Use this method when it's the users first time rating a college
	 */
	public function addToRatings($collegeID, $rating)
	{
		$first = $this->isFirst($collegeID);
		$newTotalRating;
		$newTotalRaters;
		if ($first === true)
		{
			$newTotalRaters = 1;
			$newTotalRating = $rating;
		}
		else
		{
			$newTotalRating = $rating + $first; // adds the new rating to the previous total rating of the college
			$id2 = $this->_dbConnection->selectFromTable("CollegeSummary", "CollegeID", $collegeID);
			$totalRaterArray = $this->_dbConnection->formatQueryResults($id2, "CollegeRaters");
			$oldRaters = $totalRaterArray[0];
			$newTotalRaters = $oldRaters + 1; // increments raters for this college
		}
		$newRatingArray = array( "CollegeRating" => $newTotalRating );
		$newRatersArray = array( "CollegeRaters" => $newTotalRaters );
		// pushes new rating and user to db
		$this->_dbConnection->updateTable("CollegeSummary","CollegeSummary", "CollegeID", $collegeID, "CollegeID", $newRatingArray, "CollegeID = '$collegeID'");
		$this->_dbConnection->updateTable("CollegeSummary","CollegeSummary", "CollegeID", $collegeID, "CollegeID", $newRatersArray, "CollegeID = '$collegeID'");
	}
} // END class 