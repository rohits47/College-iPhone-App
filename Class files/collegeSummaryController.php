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
	
	public function __construct()
	{
		$relation = new relationalDbConnections('lala', 'localhost:8889', 'root', 'root');
		//insert operations to load database here.....
	}
	
	/**
	 * main()
	 * the function that will execute the sequence that will fill the entire databank.
	 */
	public function main()
	{
		
	}
	
	public function getCollegeList()
	{
		

	//	return $extracted;
	}
	
	
} // END class 