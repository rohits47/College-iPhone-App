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
		$sportsArray = array("badminton","baseball", "basketball", "bowling", "boxing", "cross country", "fencing", "field hockey", "football", "golf", "gymnastics", "ice hockey", "track", "lacrosse", "rifle", "rowing", "skiing", "soccer", "softball", "swimming", "diving", "tennis", "volleyball", "water polo", "wrestling");
		
		$greekClubsArray = array("alpha", "beta", "delta", "zeta", "theta", "kaapa", "sigma", "tau", "omega");
		$proffessionTags = array("professor", "doctor");
		$researchArray = array("research", "laboratory", "institute", "institution");
		$artsArray = array("orchestra", "music", "harmonics", "visual arts", "a cappella");
		$completeArray = array_merge($sportsArray, $greekClubsArray, $proffessionTags, $artsArray);
		
	//	print_r($completeArray);
		
		$filteredArray = array();
	//	print_r(count($array));
	//	print_r(count($completeArray));
		
		for($i = 0; $i < count($array); $i++)
		{
			for($j = 0; $j < count($completeArray); $j++)
			{
				$subString = stristr($array[$i], $completeArray[$j]);
				if($subString !== false) 
				{
					$filteredArray[] = $array[$i];
					break;
				}
			}
		}
		
		//checkpoint: the $filteredArray should have an array of all the valid values; Next step is to parse them into categories...
	//	print_r($filteredArray);
		$finalArray = array();
		for($i = 0; $i < count($filteredArray); $i++)
		{
			if(parser::findStringInArray($filteredArray[$i], $sportsArray)) 
			{
				$finalArray[] = array($filteredArray[$i], "sports");
			}
			if(parser::findStringInArray($filteredArray[$i], $proffessionTags))
			{
				$finalArray[] = array($filteredArray[$i], "professor");
			} 
			if(parser::findStringInArray($filteredArray[$i], $greekClubsArray)) 
			{
				$finalArray[] = array($filteredArray[$i], "clubs");
			}
			if(parser::findStringInArray($filteredArray[$i], $researchArray))
			{ 
				$finalArray[] = array($filteredArray[$i], "research");
			}
			if(parser::findStringInArray($filteredArray[$i], $artsArray))
			{ 
				$finalArray[] = array($filteredArray[$i], "arts");
			}
		}
		return $finalArray;
		
	}
	

	
	
} // END class 