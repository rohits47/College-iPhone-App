<?PHP
function __autoload($class)
{
	require_once $class . '.php';
}

//print 'test';

//$dbConnection = new relationalDbConnections('collegeSummary', "localhost", "root", "");
$ratings = new ratings(new relationalDBConnections('lala', 'localhost:8889', 'root', 'root'));
//$ratings->addToRatings("Huntingdon College", 3);
//$ratings->updateRatings("Huntingdon College", 5, 3);
//$ratings->getAverageRating("Huntingdon College");
//print 'testend';

?>