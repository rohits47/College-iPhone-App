<?PHP
/**
 * Tester File for the urlParser.php file.
 * Provides a log of all the tests run on this class
 * Should be referenced when debugging a class when something goes wrong.
 * ###########################################
 * LOG:										##
 * This is where the log should be held		##
 * 07/25: Log Created						##
 * 											##
 * ###########################################
 */

// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}


//Simple test being run
//Should excute time tests as well.
//It now can take the page and retrieve the URL content; Time to implement the parsing of all links.
print_r(urlParser::cURL("http://en.wikipedia.org/w/api.php?format=json&action=query&titles=Harvard_University&rvprop=content&prop=revisions&redirects=1"));
	
	echo "hello World";

?>