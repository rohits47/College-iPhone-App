<?PHP
/**
 * dnUtilities class
 * Should contain all the utility functions such as add, remove, add(obj, index), get(i), etc.
 *
 * @package default
 * @author Abhinav  Khanna
 **/
class dnUtilities
{
	private $_size;
	private $_node;
	
	public function __constructor($doubleNode)
	{
		$this->_node = $doubleNode;
		$this->_size = 1;
	}
	
	
	/**
	 * Adds the value $obj to the end of a function
	 * @param: $obj is the value which you wish to add to the end of the list;
	 */
	public function add($obj)
	{
		$node = $this->_node;
		while($this->_node->getNext() != null)
		{
			$node = $this->_node->getNext();
		}
		
		$node->setNext(new doubleNode($obj, null));
		$this->_node = $node;
	}
	
	
	public function remove($index)
	{
		throw new Exception("Write Me");
	}
	
	public function addAtIndex($obj, $index)
	{
		throw new Exception("Write Me");
	}
	
	public function get($index)
	{
		throw new Exception("Write Me");
	}
	
	public function size()
	{
		return $this->_size;
	}
	
} // END class 