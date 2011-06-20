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
	protected $_baseURL;
	
	//methods here
	public function __construct($dbConnection, $college)
	{
		$this->_dbConnection = $dbConnection;
		$this->_format = "json";
		$this->_action = "query";
		$this->_titles = $college;
		$this->_baseURL = "http://en.wikipedia.org/w/api.php?";
		$this->_apiURL = "http://en.wikipedia.org/w/api.php?format=" . $this->_format . "&action=" . $this->_action . "&prop=" . $this->_prop . "&titles=" . $this->_titles;
	}
	
	/**
	 * public function wikiLinks
	 * Postcondition: the links from wikipedia are stored into Database.
	 */
	public function wikiLinks()
	{
		
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
	//	print_r($this->_apiURL . "\n");
		$source = urlParser::cURL($this->_apiURL);
	//	print_r($source);
		$decoded = unserialize($source);
	//	print_r($decoded);
		
		//the page ID: currently 26977, has to be changed to a dynamic link not hardcoded.
		$imagesArray = $decoded["query"]["pages"]["26977"]["images"];
	//	print_r($imagesArray);
		$imageTitleArray = array();
		for($i = 0; $i < count($imagesArray); $i++)
		{
			$imageTitleArray[$i] = $imagesArray[$i]["title"];
		}
	//	print_r($imageTitleArray);
		
		
	
	}
	
	public function wikiSnippet()
	{
		
	}
	
	public function wikiDivSports()
	{
		
		
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
	
	public function setAPIUrl()
	{
		$this->_apiURL = $this->_baseURL . "format=" . $this->_format . "&action=" . $this->_action . "&prop=" . $this->_prop . "&titles=" . $this->_titles;
	}
	
	public function getAPIUrl()
	{
		return $this->_apiURL;
	}
} // END class 