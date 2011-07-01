<?PHP
// The function __autoload is the method for loading all the classes being used in the script. Use it at the beginning of every php main
// page.
function __autoload($class)
{
	require_once $class . '.php';
}


$c = new collegeSummaryController();

$c->main();

?>