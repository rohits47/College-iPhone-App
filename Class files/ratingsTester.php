<?PHP
function __autoload($class)
{
	require_once $class . '.php';
}

$dbConnection = new relationalDbConnections('collegeSummary', "localhost", "root", "");



?>