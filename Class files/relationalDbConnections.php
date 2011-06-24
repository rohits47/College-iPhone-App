<?PHP
/**
 * relationalDbConnections class
 *
 * @package default
 * @author Abhinav  Khanna
 **/
class relationalDbConnections extends dbConnections
{
	
	public function __construct($dbname, $dbhost, $dbuser, $dbpass = null)
	{
		parent::__construct($dbname, $dbhost, $dbuser, $dbpass);
		$this->_conn = $this->open_db_connection();
	}
	
	public function selectWithJoin()
	{
		throw new Exception("Implement Me!");
	}
	
	public function insertIntoTable($tableName1, $keyTable, $foreignKey, $valueForKey, $primaryKey, $arrayOfValues)
	{
		$result = $this->selectFromTable($keyTable, $foreignKey, $valueForKey);
		$num = mysql_num_rows($result);
		if($num == 0)
		{
			$array = array($foreignKey => "$valueForKey");
			parent::insertIntoTable($keyTable, $array);
			$result1 = parent::selectFromTable($keyTable, $foreignKey, $valueForKey);
			$formatted = $this->formatQueryResults($result1, $primaryKey);
			$arrayOfValues[$primaryKey] = $formatted[0];
			parent::insertIntoTable($tableName1, $arrayOfValues);
			return true;
		}
		else
		{
			$formatted = $this->formatQueryResults($result, $primaryKey);
			$arrayOfValues[$primaryKey] = $formatted[0];
			parent::insertIntoTable($tableName1, $arrayOfValues);
		}
		
	}
	
} // END class 