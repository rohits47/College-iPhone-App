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
	 * Public wikiParser
	 * Postcondition: Should store the first two paragraphs of all University Wiki pages. Stores this as wikiSnippet.
	 * @Author: Rohit S.
	 */
	public static function wikiParser()
	{
		
	}
	
	/**
	 * Public grabHighlights
	 * PostCondition: Grabs all the links on the page.
	 */
	public static function grabHighlights()
	{
		
	}
	
	
} // END class 