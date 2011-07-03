<?PHP
/**
 * facebookController class
 *
 * @package default
 * @author Abhinav  Khanna
 **/
class fbController extends wikipediaController
{
	
	protected $_facebook;
	protected $_baseURL;
	
	public function __construct($relationalDBConnection, $college)
	{
		parent::__construct($relationalDBConnection, $college);
		$this->_facebook = new Facebook(array(
			'appId' => "166319723434460",
			'secret' => "8a3528c5a80f960dda2acb52127136ab",
		));
		
		$this->_baseURL = "http://graph.facebook.com";
	}
	
	public function getFBSummary()
	{
		$college = str_replace(" ", "", $this->_college);
		$this->setTitle($college);
		$url = $this->_baseURL . "/search?q=$this->_titles&type=page";
		$source = urlParser::cURL($url);
		$decoded = json_decode($source);
		$id = 0;
		for($i = 0; $i < count($decoded->data); $i++)
		{
			$val = $decoded->data[$i]->category;
			if($val == "education" || $val == "university" || $val == "Education" || $val == "University")
			{
				$id = $decoded->data[$i]->id;
				break;
			}
		}
		
		$url = $this->_baseURL . "/" . $id;
		
		$source = urlParser::cURL($url);
		$decoded = json_decode($source);
		$generalInfo = $decoded->general_info;
		$generalInfo = str_replace("\"", "'", $generalInfo);
		$generalInfo = str_replace("'", "", $generalInfo);
	//	$address = $decoded->location->street . " " . $decoded->location->city . ", " . $decoded->location->state;
		$array = array("Summary" => "$generalInfo");

		$this->_dbConnection->updateTable("CollegeSummary", "CollegeSummary", "CollegeName", $this->_college, "CollegeID", $array, "CollegeName = '$this->_college'");
		
	}

} 