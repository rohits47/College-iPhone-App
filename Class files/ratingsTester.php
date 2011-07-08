<?PHP
function __autoload($class)
{
	require_once $class . '.php';
}

//print 'test';

//$dbConnection = new relationalDbConnections('collegeSummary', "localhost", "root", "");
$ratings = new ratings(new relationalDBConnections('lala', 'localhost:8889', 'root', 'root'));
//$ratings->addToRatings("Huntsville Bible College", 3);
//$ratings->updateRatings("Huntsville Bible College", 4, 3);
$ratings->getAverageRating("Huntsville Bible College");
//print 'testend';

?>