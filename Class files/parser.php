<?PHP
/**
 *  Parser class
 *	Purpose of the class is to parse strings. Common functions include:
 * 						1) The ability to separate a string given a key
 * 						2) General Utils
 * 						All methods will be final and static
 * @package default
 * @author Abhinav  Khanna and Rohit S.
 **/
class parser
{
	
	
	public static function stringBreaker($str)
	{
		
	}
	
	/**
	 * To be used as part of wikiSnippet in wikipediaController.php
	 * @return: the string of text associated with the keyword that was extracted from the array.
	 */
	public static function parseSnippet($keyword, $arrayStr)
	{
		$str = "";
		if (strpos($arrayStr,$keyword))
		{
			$pos1 = strpos($arrayStr, $keyword);
			$bigStr = substr($arrayStr, $pos1+1); // cut off everything before keyword, including the starting "|"
			$pos2 = strpos($bigStr, "= ");
			$bigStr2 = substr($bigStr, $pos2+2); // cut off keyword and "= "
			$pos3 = strpos($bigStr2,"|");
			$pos4 = strpos($bigStr2,"<ref");
			$min = min($pos3, $pos4);
			$str = substr($bigStr2, 0, $min);
		}
		return $str;
	}
	
	public static function refineSnippet($str, $case = null)
	{
		$array = array("{", "}", "[", "]", ","); // chars to eliminate
		for ($i=0; $i < count($array); $i++) { 
			$str = str_replace($array[$i], "", $str);
		}
		if (!is_null($case) && ($case == "established" || $case == "faculty" || $case == "undergrad" || $case == "postgrad" || $case == "staff"))
		{
			$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
			$posArray = array();
			for ($i=0; $i < count($array); $i++)
			{
				$posArray[] = strrpos($str, $array[$i]); // keeps array of positions of last nums in string
			}
			$lastPos = max($posArray); // the last number in the array
			$str = substr($str, 0, $lastPos+1);
		}
		return $str;
		//traverse string
		//if found, replace string with null strings (essentially delete them)
	}
	
	/**
	 * findStringInArray
	 * @param: $string is the string you are looking for;
	 * @param: $array is the array being searched for the string;
	 * @return true if the $string is found in $array;
	 * @return false if the $string is not found in the $array;
	 */
	public static function findStringInArray($string, $array)
	{
		for($i = 0; $i < count($array); $i++)
		{
		//	print_r($string . " " . $array[$i] . " ");
			$string = strtolower($string);
			if(strpos($string, $array[$i]) !== false)
			{
				return true;
			}
		}
		return false;
	}
	
} // END class 