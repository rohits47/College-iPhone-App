<?PHP
function __autoload($class)
{
	require_once $class . '.php';
}

$dbConnection = new relationalDbConnections('lala', "localhost:8889", "root", "root");
$wikipediaController = new wikipediaController($dbConnection, "Stanford_University");

$wikipediaController->wikiPictures();
?>