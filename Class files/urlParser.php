<?PHP
/**
 * urlParser class
 *	Purpose is to parse the content of a given url Page. 
 * All methods are static as this is a UTIL class as well. No need to have it be instantiated in object form.
 * Parses content that is specific to urls and not to simply text. Has a broader usage than parser.php
 * 
 * ************************************************************************************************************
 * Separates values from a grand collection of strings or an array of strings.....
 * ************************************************************************************************************
 * Notes:
 * 
 * 1) This class may need some refactoring at a later time. It seems like this has become a catch all group for functions we could
 * not place earlier.
 * 
 * 2) We need to add a file_get_Contents function type thing.....
 * 
 * ************************************************************************************************************
 * 
 * 
 * @package default
 * @author Abhinav  Khanna and Rohit Sandbhati.
 **/
class urlParser extends parser
{
	/**
	 * Public static function cURL
	 * @operates using the cURL library provided by PHP....
	 * @param $url is the url you wish to cUrl.
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
	 * Public function parseContent
	 * @param $array is the array of values you want to place into separate bins.
	 * @operates by comparing against a static set of bins
	 * TODO: Add a dynamic binninng system that will allow the computer to grow its number of bins based upon what data it collects.
	 * TODO: Currently all items not binned get deleted, ideally they should be tagged with the ID of Links and separated.
	 * @return an ARRAY containing all the binned values in the form of array(array(binned_value, category), array(binned_value, ...)...)
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
		$linksArray = array();
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
				else
					$linksArray[] = $array[$i];
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
	
	public static function compareSearchArray($array, $completeArray, $case)
	{
		$filteredArray = array();
	//	print_r(count($array));
	//	print_r(count($completeArray));
		if($case == true)
		{
			for($i = 0; $i < count($array); $i++)
			{
				for($j = 0; $j < count($completeArray); $j++)
				{
					$subString = strstr($array[$i], $completeArray[$j]);
					if($subString !== false) 
					{
						if(strlen($array[$i]) != strlen($completeArray[$j]))
						{
							$filteredArray[] = $array[$i];
							break;
						}
					}
				}
			}
		
			return $filteredArray;
		}
		else
		{
			for($i = 0; $i < count($array); $i++)
			{
				for($j = 0; $j < count($completeArray); $j++)
				{
					$subString = stristr($array[$i], $completeArray[$j]);
					if($subString !== false) 
					{
						if(strlen($array[$i]) != strlen($completeArray[$j]))
						{
							$filteredArray[] = $array[$i];
							break;
						}
					}
				}
			}
		
			return $filteredArray;
		}
	}
	

	
	
} // END class 