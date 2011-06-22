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
	protected $_titles;
	protected $_additionalProperties;
	protected $_baseURL;
	
	//methods here
	public function __construct($dbConnection, $college)
	{
		$this->_dbConnection = $dbConnection;
		$this->_format = "json";
		$this->_action = "query";
		$this->_titles = $college;
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
		$this->setProp("extlinks"); // iwlinks as well?
		$this->setFormat("php");
		$this->setAPIUrl();
		$source = urlParser::cURL($this->_apiURL);
		$decoded = unserialize($source);
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
		//the page ID: currently 26977, has to be changed to a dynamic link not hardcoded.
		$imagesArray = $decoded["query"]["pages"]["26977"]["images"];
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
			//Need to replace the whiteSpace in the $imageTitleArray with "_" values.
			$this->setTitle($imageTitleArray[$i]);
			$this->setAPIUrl();
			print_r($this->getAPIUrl() . "<p>");
			$source = urlParser::cURL($this->getAPIUrl());
			print_r($source . "<p>");
			$decode = unserialize($source);
		//	$tempArray[] = $decode["query"]["pages"][-1]["imageinfo"][0]["url"];
		}
	//	print_r($tempArray);
	
	}
	
	public function wikiSnippet()
	{
		$this->setProp("revisions"); // section 0
		$this->setFormat("php");
		$this->setAPIUrl();
		$source = urlParser::cURL($this->_apiURL);
		$decoded = unserialize($source);
	}
	
	public function wikiDivSports()
	{
		$this->setProp("");
		$this->setFormat("php");
		$this->setAPIUrl();
		$source = urlParser::cURL($this->_apiURL);
		$decoded = unserialize($source);
	}
	
	public function getPageID()
	{
		throw new Exception("Implement Me!");
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