<?PHP
function __autoload($class)
{
	require_once $class . '.php';
}

//print 'test';

//$dbConnection = new relationalDbConnections('collegeSummary', "localhost", "root", "");
$ratings = new ratings(new relationalDBConnections('lala', 'localhost:8889', 'root', 'root'));
//$ratings->addToRatings(6, 3);
//$ratings->updateRatings(6, 3, 5);
//$ratings->getAverageRating(6);
//print 'testend';

?>