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
	 */
	public function main()
	{
	//	$this->setCollegeList();
		$formatted = $this->getCollegeList();
		
		for($i = 0; $i < count($formatted); $i++)
		{
			$wiki = new wikipediaController($this->_relation, $formatted[$i]);
		//	$fb = new fbController($this->_relation, $formatted[$i]);
		//	$wiki->wikiPictures();
		//	$wiki->wikiLinks();
			$wiki->wikiSnippet();
		//	$fb->getFBSummary();
		}
	}
	
	/**
	 * function for getting and storing the entire collegeList
	 */
	private function setCollegeList()
	{
		
		$stateList = array("Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","District Of Columbia","Florida", "Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky", "Louisiana","Maine","Maryland","Massachusetts","Michigan", "Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio", "Oklahoma","Oregon", "Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah", "Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming");
		
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
	
	public function getCollegeList()
	{
		$result = $this->_dbConnection->selectFromTable("CollegeSummary");
		$formatted = $this->_dbConnection->formatQueryResults($result, "CollegeName");
		
		return $formatted;
		
	}
	

	
} // END class 