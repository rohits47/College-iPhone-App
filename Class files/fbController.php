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
	
	public function __construct($relationalDBConnection, $college)
	{
		parent::__construct($relationalDBConnection, $college);
		$this->_facebook = new Facebook(array(
			'appId' => "166319723434460",
			'secret' => "8a3528c5a80f960dda2acb52127136ab"
		));
	}
	
	public function getFBSummary()
	{
		
	}

} 