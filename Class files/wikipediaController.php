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
	protected $_college;
	
	//methods here
	public function __construct($dbConnection, $college)
	{
		$this->_dbConnection = $dbConnection;
		$this->_college = $college;
		$this->_apiURL = "http://en.wikipedia.org/w/api.php?";
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
		
	}
	
	public function wikiSnippet()
	{
		
	}
	
	public function wikiDivSports()
	{
		
		
	}
} // END class 