<?PHP
/**
 *  Parser class
 *	Purpose of the class is to parse strings. Common functions include:
 * 						1) The ability to separate a string given a key
 * 						2) General Utils
 * 						All methods will be final and static
 * @package default
 * @author Abhinav  Khanna
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
	
} // END class 