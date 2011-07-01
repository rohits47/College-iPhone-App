<?PHP
function __autoload($class)
{
	require_once $class . '.php';
}

//print 'test';

//$dbConnection = new relationalDbConnections('collegeSummary', "localhost", "root", "");
$ratings = new ratings(new relationalDBConnections('lala', 'localhost:3306', 'root', 'root'));
$ratings->addToRatings("Huntsville Bible College", 3);

//print 'testend';

?>