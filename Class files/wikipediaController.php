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
	public function __construct($dbConnection, $college)
	{
		$this->_dbConnection = $dbConnection;
		$this->_format = "json"; // should this be php?
		$this->_action = "query";
		$this->_titles = $college;
		$this->_college = $college;
		$this->_additionalProperties = "";
		$this->_baseURL = "http://en.wikipedia.org/w/api.php?";
		$this->_apiURL = "http://en.wikipedia.org/w/api.php?format=" . $this->_format . "&action=" . $this->_action . "&prop=" . $this->_prop . "&titles=" . $this->_titles . $this->_additionalProperties;
	}
	
	/**
	 * public function wikiLinks()
	 * Postcondition: the links from wikipedia are stored into Database.
	 */
	public function wikiLinks()
	{
		$this->setProp("links");
		$this->setFormat("php");
		$this->setAdditionalProperties("&pllimit=5000"); // 500 = max limit allowed
		$this->setAPIUrl();
		//print_r($this->getAPIUrl());
		$source = urlParser::cURL($this->_apiURL);
		$decoded = unserialize($source);
		//print_r($decoded);
		$parentTitlesArray = $decoded["query"]["pages"]["26977"]["links"]; // replace 26977 with pageid
		//print_r($temp);
		$titlesArray = array();
		for ($i=0; $i < sizeof($parentTitlesArray); $i++) // should this use count?
		{ 
			$titlesArray[$i] = $parentTitlesArray[$i]["title"];
		}
		
		//print_r($titlesArray);
		
		// titlesArray is populated with all the titles. If it needs to be pruned or processed in any way before passing to urlParser, do so here.
		
		// pass titlesArray to abhi's urlparser method, will sort and check titles
	}
	
	/**
	 * Public function wikiPictures()
	 * Postcondition: returns and stores the pictures in the Database.
	 */
	public function wikiPictures()
	{
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
	//	print_r($tempArray);
	
	/**
	 * This part stores the values into the database;
	 */
	}
	
	// get info from list of properties, and use array elements to extract relevant info and keep in vars
	public function wikiSnippet()
	{
		$this->setProp("revisions"); // section 0
		$this->setFormat("txtfm");
		$this->setAdditionalProperties("&rvprop=content&rvsection&section=0"); // text content of page, only the text which appears before TOC
		$this->setAPIUrl();
		$source = urlParser::cURL($this->_apiURL);
	//	$decoded = unserialize($source);
	//	$valueArray = $decoded["query"]
	//	print_r($source);
	}
	
	// to be split among snippets and links (section 7)
	// later, compare links to db of sports
	public function wikiDivSports()
	{
		$this->setProp("");
		$this->setFormat("php");
		$this->setAPIUrl();
		$source = urlParser::cURL($this->_apiURL);
		$decoded = unserialize($source);
	}
	
	
	
	public function setAction($action)
	{
		$this->_action = $action;
	}
	
	public function setFormat($format)
	{
		$this->_format = $format;
	}
	
	public function setProp($prop)
	{
		$this->_prop = $prop;
	}
	
	public function setTitle($title)
	{
		$this->_titles = $title;
	}
	
	public function setAdditionalProperties($properties)
	{
		$this->_additionalProperties = $properties;
	}
	
	public function getAdditionalProperties()
	{
		return $this->_additionalProperties;
	}
	
	public function setAPIUrl()
	{
		$this->_apiURL = $this->_baseURL . "prop=" . $this->_prop . "&action=" . $this->_action . "&format=" . $this->_format . "&titles=" . $this->_titles . $this->_additionalProperties;
	}
	
	public function getAPIUrl()
	{
		return $this->_apiURL;
	}
} // END class 