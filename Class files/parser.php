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
	
	public static function parseNew($keyword, $arrayStr)
	{
		$str = "";
		if (strpos($arrayStr,$keyword))
		{			
			$pos1 = strpos($arrayStr, $keyword);			
			$bigStr = substr($arrayStr, $pos1+1); // cut off everything before keyword, including the starting "|"
			$pos2 = strpos($bigStr, "=");
			$bigStr2 = substr($bigStr, $pos2+1); // cut off keyword and "="
			$posN = strpos($bigStr2,"\n");
			$str1 = substr($bigStr2, 0, $posN);	
			
			$values = array();
			$pos3 = strpos($str1,"|");
			
			if($pos3 !== false) $values[] = $pos3;
			$pos4 = strpos($str1,"<ref");
			if($pos4 !== false) $values[] = $pos4;
			$pos5 = strpos($str1, "}");
			if($pos5 !== false) $values[] = $pos5;			
			$min = min($values);
			$str = substr($str1, 0, $min);
		}
		if ($str == "")
		{
			$str = "N/A";
		}	
		return $str;
	}
	
	//useless
	public static function removeDuplicates($str)
	{
     	$words = explode(" ", trim($str));
        $len = count($words);
        for ($i = 0; $i < $len; $i++)
        {
                for ($p = 0; $p < $len; $p++)
                {
                        if ($p != $i && $words[$i] == $words[$p])
                        {
                                return false;
                        }
                }
        }
        return true;
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
			$pos2 = strpos($bigStr, "=");
			$bigStr2 = substr($bigStr, $pos2+1); // cut off keyword and "="
			$values = array(); // array to hold values for positions of cutoff characters
			$pos3 = strpos($bigStr2,"|");
			
			if($pos3 !== false) $values[] = $pos3;
			$pos4 = strpos($bigStr2,"<ref");
			if($pos4 !== false) $values[] = $pos4;
			$pos5 = strpos($bigStr2, "}");
			if($pos5 !== false) $values[] = $pos5;			
			$min = min($values);
			$str = substr($bigStr2, 0, $min);		
			return $str;
		}
		else
			return false; // unable to parse
	}
	
	public static function deepParseSnippet($keyword, $arrayStr)
	{
		$pos1 = strpos($arrayStr, $keyword);
		$bigStr = substr($arrayStr, $pos1+1); // cut off everything before keyword, including the starting "|"
		if ($keyword == "|endowment")
		{
			$pos2 = strpos($bigStr, "$");
			$bigStr2 = substr($bigStr, $pos2, 100); // cut off keyword and everything before the "$", arbitrary endpoint for string
			$array = array("billion", "million", "thousand");
			$posArr = array();
			for ($i=0; $i < count($array); $i++)
			{
				$posArr[] = strpos($bigStr2, $array[$i]);
			}
			$lastPos = max($posArr);
			//$pos3 = strpos($bigStr2,"|");
			//$pos4 = strpos($bigStr2,"<ref");
			//$min = min($pos3, $pos4);
			$str = substr($bigStr2, 0, $lastPos+8);
			$array2 = array("(number)", "1000","000"); // chars to eliminate
			for ($i=0; $i < count($array2); $i++)
			{
				$str = str_replace($array2[$i], "", $str);
			}
		}
		elseif ($keyword == "|athletics" || $keyword == "|free")
		{
			$pos2 = strpos($bigStr, "=");
			$bigStr2 = substr($bigStr, $pos2+1); // cut off keyword and "="
			$array1 = array("{", "website", "url", "free");
			$posArr = array();
			for ($i=0; $i < count($array1); $i++)
			{
				$posArr[] = strpos($bigStr2, $array1[$i]);
			}
			$pos3 = min($posArr);
			$str = substr($bigStr2, 0, $pos3);
			$array = array("National","Collegiate","Athletic","Association","University","Athletic","Association");
			for ($i=0; $i < count($array); $i++)
			{
				$str = str_replace($array[$i], "", $str);
			}
		}
		return $str;
	}
	
	public static function refineSnippet($str, $case = null)
	{
		$array = array("{", "}", "[", "]", ",", "|", "<", ">", "'", '"'); // chars to eliminate
		for ($i=0; $i < count($array); $i++)
		{
			$str = str_replace($array[$i], "", $str);
		}
		if (!is_null($case) && ($case == "established" || $case == "faculty" || $case == "undergrad" || $case == "postgrad"))
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