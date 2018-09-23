<?php

class BaseClass extends Tools
{
	/** @var string */
	protected $out;

	/** @var array */
	protected $data;
	
	private static $instances = [];
	
	public static function getInstance()
	{
		 $className = get_called_class();
		 if(!isset(self::$instances[$className])) {
			 self::$instances[$className] = new $className();
		 }
		 
		 return self::$instances[$className];
	}	
	
	public function getView($viewName)
	{
		ob_start();
		if(is_file(BASE_DIR."view/$viewName.phtml")) {
			require BASE_DIR.'view/'.$viewName.'.phtml';
		}
		return ob_get_clean();
	}
	
	public function getAllInstances()
	{
		return self::$instances;
	}
	
	public function getFileVersion($fileName)
	{
		$time = filemtime(BASE_DIR.$fileName);
		return "$fileName?version=$time";
	}
	
	public function toString() { return $this->out; }
	public function write() { echo $this->out; }
	public function __toString() { return $this->toString(); }
}

