<?PHP
require 'facebook-sdk/src/facebook.php';
// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}


$dbConnection = new relationalDbConnections('lala', "localhost:8889", "root", "root");
$fb = new fbController($dbConnection, "Carnegie Mellon University");

$fb->getFBSummary();

?>