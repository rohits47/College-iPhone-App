<?PHP
/**
 * doubleNode class
 *
 * @package default
 * @author Abhinav  Khanna
 **/
class doubleNode
{
	protected $_value;
	protected $_next;
	protected $_last;
	
	public function __construct($value, $next)
	{
		$this->_value = $value;
		$this->_next = $next;
	}
	
	public function getNext()
	{
		return $this->_next;
	}
	
	public function getPrevious()
	{
		return $this->_last;
	}
	
	public function setNext($node)
	{
		$oldValue = $this->_next;
		$this->_next = $node;
		return $oldValue;
	}
	
	public function setValue($value)
	{
		$oldValue = $this->_value;
		$this->_value = $value;
		return $oldValue;
	}
	
	public function setLast($node)
	{
		$oldValue = $this->_last;
		$this->_last = $oldValue;
		return $oldValue;
	}
	
	
} // END class 