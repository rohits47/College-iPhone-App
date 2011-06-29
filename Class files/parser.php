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
		if (strpos($arrayStr,$keyword))
		{
			$pos1 = strpos($arrayStr, $keyword);
			$bigStr = substr($arrayStr, $pos1); // whole string starting from keyword
			$pos2 = strpos($bigStr,"|") + $pos1;
			$str = substr($arrayStr, 1, $pos2);
			//print_r($bigStr);
		}
		return $str;
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