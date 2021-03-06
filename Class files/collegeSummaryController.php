<?PHP
/**
 * collegeSummaryController class
 * This class will control the concatenation of the the collegeData passed to it.
 * When called via JavaScript the implementation file will toss out a concatenated JSON of features for a given college.
 * Not sure if to make it a static class or a normal class...
 *
 * @package default
 * @author Abhinav  Khanna
 **/
class collegeSummaryController
{
	protected $_wikipedia;
	protected $_dbConnection;
	protected $_relation;
	
	public function __construct()
	{
		$relation = new relationalDbConnections('lala', 'localhost:8889', 'root', 'root');
		$this->_relation = $relation;
		$this->_dbConnection = new dbConnections('lala', 'localhost:8889', 'root', 'root');
		$college = "Stanford_University";
		$this->_wikipedia = new wikipediaController($relation, $college);
		//insert operations to load database here.....
	}
	
	/**
	 * main()
	 * the function that will execute the sequence that will fill the entire databank.
	 * Runs:
	 * 			Wikipictures
	 * 			Wikilinks
	 * 			WikiSnippet
	 * 			WikiSummary
	 * 			FacebookSummary
	 * Current RunTime: Log here.......
	 */
	public function main()
	{
		$this->setCollegeList();
		$formatted = $this->getCollegeList();
		
		for($i = 0; $i < count($formatted); $i++)
		{
			$wiki = new wikipediaController($this->_relation, $formatted[$i]);
			$fb = new fbController($this->_relation, $formatted[$i]);
			$wiki->wikiPictures();
			$wiki->wikiLinks();
			$wiki->wikiSnippet();
			$wiki->wikiSummary();
			$fb->getFBSummary();
		}
	}
	
	/**
	 * Public function setCollegeList
	 * No parameters
	 * 
	 * @operates by searching wikipedia for all the state college categories and scraping all the college names.
	 * Should get 3147 colleges as of 07/25/11
	 * 
	 * Postcondition: the database is loaded with all the scrapeable colleges off of wikipedia.
	 */
	private function setCollegeList()
	{
		
		$stateList = array("Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Washington, D.C.","Florida", "Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky", "Louisiana","Maine","Maryland","Massachusetts","Michigan", "Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio", "Oklahoma","Oregon", "Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah", "Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming");
		
		$filteringKeywords = array("University", "College");
		
		$totalLinks = array();
		
		for($i = 0; $i < count($stateList); $i++)
		{
			$temp = array();
			$links = $this->_wikipedia->getLinks("List_of_colleges_and_universities_in_" . $stateList[$i]);
			for ($j=0; $j < count($links); $j++) // should this use count?
			{
				$temp[$j] = $links[$j]["title"];
			}
			$totalLinks = array_merge($totalLinks, $temp);
		}
		$filteredArray = urlParser::compareSearchArray($totalLinks, $filteringKeywords, true);
		for($i = 0; $i < count($filteredArray); $i++)
		{
		//	print_r($filteredArray[$i]);
		//	print_r("<p>");
			$array_fieldValues = array("CollegeName" => $filteredArray[$i]);
			$this->_dbConnection->insertIntoTable("CollegeSummary", $array_fieldValues);
		}
	
	}
	
	/**
	 * Public function getCollegeList()
	 * No parameters
	 * @return the entire college list stored in the database: CollegeSummary;
	 */
	public function getCollegeList()
	{
		$result = $this->_dbConnection->selectFromTable("CollegeSummary");
		$formatted = $this->_dbConnection->formatQueryResults($result, "CollegeName");
		
		return $formatted;
		
	}
	

	
} // END class 