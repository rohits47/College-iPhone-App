<?PHP
/**
 * cURL class
 *	Purpose is to parse the content of a given url Page. 
 * All methods are static as this is a UTIL class as well. No need to have it be instantiated in object form.
 * @package default
 * @author Abhinav  Khanna
 **/
class urlParser extends parser
{
	
	/**
	 * Public static function cURL
	 * @return: a variable containing the contents of the curl.
	 * Needs further testing, doesn't seem to do anything at the moment.
	 */
	public static function cURL($url)
	{
		$resource = curl_init($url);
		if($resource) {
			curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($resource, CURLOPT_USERAGENT, 'http://cytopic.net');
		}
		$contents = curl_exec($resource);
		return $contents;
	}
	
	/**
	 * parseContent function
	 * figures out what content in the $array passed to it is by matching it against sets.
	 * Currently instead of sets we are comparing against arrays, it needs to be converted to sets rather soon.
	 */
	public static function parseContent($array)
	{
		$sportsArray = array();
		$buildingArray = array("Library", "library", "Building", "building");
		$proffessionTags = array("Professor", "professor", "Dr.", "Mr.", "Mrs.", "Ms.", "");
		$majorsTags = array("law", "engineering", "Medicine", "Medical", "medicine", "medical", "architecture", "business", "economics", "");
		$completeArray = array("Library", "library", "Building", "building","Professor", "professor", "Dr.", "Mr.", "Mrs.", "Ms.", "","law", "engineering", "Medicine", "Medical", "medicine", "medical", "architecture", "business", "economics");
		
		$filteredArray = array();
		
		for($i = 0; $i < count($array); $i++)
		{
			if(in_array($array[$i], $completeArray)) $filteredArray[] = $array[$i];
		}
		
		//checkpoint: the $filteredArray should have an array of all the valid values; Next step is to parse them into categories...
		
	}
	
	
} // END class 