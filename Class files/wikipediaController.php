<?PHP
/**
 * wikipediaController class
 *
 * @package default
 * @author Abhinav  Khanna
 **/
class wikipediaController
{
	//protected properties here
	protected $_apiURL;
	protected $_dbConnection;
	protected $_format;
	protected $_action;
	protected $_prop;
	protected $_college;
	protected $_titles;
	protected $_additionalProperties;
	protected $_baseURL;
	
	//methods here
	public function __construct($relationalDBConnection, $college)
	{
		$this->_dbConnection = $relationalDBConnection;
		$this->_format = "json"; // should this be php?
		$this->_action = "query";
		$this->_titles = $college;
		$this->_college = str_replace(" ", "_", $college);
		$this->_additionalProperties = "";
		$this->_baseURL = "http://en.wikipedia.org/w/api.php?";
		$this->_apiURL = "http://en.wikipedia.org/w/api.php?format=" . $this->_format . "&action=" . $this->_action . "&prop=" . $this->_prop . "&titles=" . $this->_titles . $this->_additionalProperties;
	}
	
	/**
	 * Returns an array of links from wikipedia;
	 */
	public function getLinks($title)
	{
		$title = str_replace(" ", "_", $title);
		$this->setTitle($title);
		$this->setProp("links");
		$this->setFormat("php");
		$this->setAdditionalProperties("&pllimit=500"); // 500 = max limit allowed
		$this->setAPIUrl();
		$source = urlParser::cURL($this->_apiURL);
		$decoded = unserialize($source);
		$key = key($decoded["query"]["pages"]);
		$parentTitlesArray = $decoded["query"]["pages"][$key]["links"]; // replace 26977 with pageid
		
	//	print_r($parentTitlesArray);
		
		return $parentTitlesArray;
	}
	
	/**
	 * public function wikiLinks()
	 * Postcondition: the links from wikipedia are stored into Database.
	 */
	public function wikiLinks()
	{
		$parentTitlesArray = $this->getLinks($this->_college);
		$titlesArray = array();
		for ($i=0; $i < count($parentTitlesArray); $i++) // should this use count?
		{ 
			$titlesArray[$i] = $parentTitlesArray[$i]["title"];
		}
		// pass titlesArray to abhi's urlparser method, will sort and check titles
	//	print_r($titlesArray);
		$processedArray = urlParser::parseContent($titlesArray); // add comment about structure of parseContent.....
		// code to input into db
		$college = str_replace("_", " ", $this->_college);
		print_r($processedArray);
		for($i = 0; $i < count($processedArray); $i++)
		{
			if($processedArray[$i][1] == "sports")
			{
				$array = array("CollegeDivSports" => "{$processedArray[$i][0]}", "CollegeID" => "");
				$this->_dbConnection->insertIntoTable("CollegeDivSports","CollegeSummary", "CollegeName", $college, "CollegeID", $array);
			}
			elseif($processedArray[$i][1] == "clubs")
			{
				$array = array("CollegeClub" => "{$processedArray[$i][0]}", "CollegeID" => "");
				$this->_dbConnection->insertIntoTable("CollegeClubs","CollegeSummary", "CollegeName", $college, "CollegeID", $array);	
			}
			elseif($processedArray[$i][1] == "research")
			{
				$array = array("CollegeResearch" => "{$processedArray[$i][0]}", "CollegeID" => "");
				$this->_dbConnection->insertIntoTable("CollegeResearch","CollegeSummary", "CollegeName", $college, "CollegeID", $array);
			}
			elseif($processedArray[$i][1] == "arts")
			{
				$array = array("CollegeArt" => "{$processedArray[$i][0]}", "CollegeID" => "");
				$this->_dbConnection->insertIntoTable("CollegeArts","CollegeSummary", "CollegeName", $college, "CollegeID", $array);
			}
			else
			{
				$array = array("CollegeLink" => "{$processedArray[$i][0]}", "CollegeID" => "", "LinkTag" => "{$processedArray[$i][1]}");
				$this->_dbConnection->insertIntoTable("CollegeLinks","CollegeSummary", "CollegeName", $college, "CollegeID", $array);
			}
		}
	}
	
	/**
	 * Public function wikiPictures()
	 * Postcondition: returns and stores the pictures in the Database.
	 */
	public function wikiPictures()
	{
		$college = str_replace(" ", "_", $this->_college);
		$this->setTitle($college);
		$this->setProp("images");
		$this->setFormat("php");
		$this->setAPIUrl();
		$source = urlParser::cURL($this->_apiURL);
		$decoded = unserialize($source);
		$key = key($decoded["query"]["pages"]);
		$imagesArray = $decoded["query"]["pages"][$key]["images"];
	
		$imageTitleArray = array();
		for($i = 0; $i < count($imagesArray); $i++)
		{
			$imageTitleArray[$i] = $imagesArray[$i]["title"];
		}
		
		$tempArray = array();
		$this->setProp("imageinfo");
		$this->setAdditionalProperties("&iiprop=url");
		
		for($i = 0; $i < count($imageTitleArray); $i++)
		{
			$withoutWhiteSpace = str_replace(" ", "_", $imageTitleArray[$i]);
			$this->setTitle($withoutWhiteSpace);
			$this->setAPIUrl();
			$source = urlParser::cURL($this->getAPIUrl());
			$decode = unserialize($source);
			$tempArray[] = $decode["query"]["pages"][-1]["imageinfo"][0]["url"];
		}

		$college = str_replace("_", " ", $this->_college);
		for($i = 0; $i < count($tempArray); $i++)
		{
			if(strpos($tempArray[$i], "Padlock-silver") === false && strpos($tempArray[$i], "Magnify-clip") === false && strpos($tempArray[$i], "Platopainting") === false && strpos($tempArray[$i], "Emblem-money") === false)
			{
			
				$array = array("CollegePicture" => "$tempArray[$i]", "CollegeID" => "");
			
				//testing code
				//	print_r("$college <p>");
			
				$this->_dbConnection->insertIntoTable("CollegePictures","CollegeSummary", "CollegeName", $college, "CollegeID", $array);
			}
		}
		return true;

	}
	
	// get info from list of properties, and use array elements to extract relevant info and keep in vars
	public function wikiSnippet()
	{
		$this->setTitle($this->_college);
		$this->setProp("revisions"); // section 0
		$this->setFormat("php");
		$this->setAdditionalProperties("&rvprop=content&rvsection&section=0"); // text content of page, only the text which appears before 
		$this->setAPIUrl();
		$source = urlParser::cURL($this->_apiURL);
		$decoded = unserialize($source);
		// write parser method in parser to look for keywords in the huge string
		$valueArray = $decoded["query"]["pages"]["26977"]["revisions"]["0"]["*"];
		//print_r($valueArray);
		
		$name = parser::parseSnippet("|name", $valueArray);
		//print_r($name);
		$established = parser::parseSnippet("|established", $valueArray);
		//print_r($established);
		$type = parser::parseSnippet("|type", $valueArray);
		//print_r($type);
		$president = parser::parseSnippet("|president", $valueArray);
		$city = parser::parseSnippet("|city", $valueArray);
		$state = parser::parseSnippet("|state", $valueArray);
		$country = parser::parseSnippet("|country", $valueArray);
		$endowment = parser::parseSnippet("|endowment", $valueArray);
		//print_r($endowment);
		$faculty = parser::parseSnippet("|faculty", $valueArray);
		$undergrad = parser::parseSnippet("|undergrad", $valueArray);
		$postgrad = parser::parseSnippet("|postgrad", $valueArray);
		$campus = parser::parseSnippet("|campus", $valueArray);
		$athletics = parser::parseSnippet("|athletics", $valueArray);
		$website = parser::parseSnippet("|website", $valueArray);
		//print_r($website);
	/*	
		for ($i=0; $i < ; $i++)
		{ 
			$nameArray = 
			$establishedArray = 
			$typeArray = 
			$presidentArray = 
			$cityArray = 
			$stateArray = 
			$countryArray = 
			$endowmentArray = 
			$facultyArray = 
			$undergradArray = 
			$postgradArray = 
			$campusArray = 
			$athleticsArray = 
			$websiteArray = 
		}
		*/
		// code to add to database "CollegeSummary"
		
		//$array = array("CollegeLink" => "$titlesArray[$i]", "CollegeID" => "");
		$this->_dbConnection->updateTable("CollegeSummary","CollegeSummary", "CollegeName", $this->_college, "CollegeID", $array);		
	}
	
		
	
	protected function setAction($action)
	{
		$this->_action = $action;
	}
	
	protected function setFormat($format)
	{
		$this->_format = $format;
	}
	
	protected function setProp($prop)
	{
		$this->_prop = $prop;
	}
	
	protected function setTitle($title)
	{
		$this->_titles = $title;
	}
	
	protected function setAdditionalProperties($properties)
	{
		$this->_additionalProperties = $properties;
	}
	
	protected function getAdditionalProperties()
	{
		return $this->_additionalProperties;
	}
	
	protected function setAPIUrl()
	{
		$this->_apiURL = $this->_baseURL . "prop=" . $this->_prop . "&action=" . $this->_action . "&format=" . $this->_format . "&titles=" . $this->_titles . $this->_additionalProperties;
	}
	
	public function getAPIUrl()
	{
		return $this->_apiURL;
	}
	
	private function setCollege($college)
	{
		$this->_college = $college;
	}
	
	public function __destruct()
	{
		$this->_dbConnection->close_db_connection();
	}
} // END class 