<?php

class sqliteInterface implements genericInterface{
	private $base;
	public $lastResult;
	
	public function __construct($config) {
		$dbname=$config->sqliteFile;
		
		try {
		$this->base=new SQLite3($dbname, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
		} catch(Exception $e)
		{
			die($e);
		}

		
	}
    public function test()
    {
        echo "sqlite test";
    }
	
    public function exec($query) {
		return $this->base->exec($query);
	}
	

	public function query($query, $debug=false) {
		$return = $this->base->query($query);
		$this->lastResult=$return;
		if($debug == true && $return == false)
			echo $this->base->lastErrorMsg();;
		return $return;
	}
    
    public function executeSqlFile($file)
    {
		$sqlbrut=file_get_contents($file);
		$sqlarray = explode(";", $sqlbrut);
		foreach($sqlarray as $sql) {
			if(strlen($sql) > 3)
				$this->query($sql);
		}
    }
    
    public function errorMsg()
    {
		return $this->base->lastErrorMsg();
	}
	
	public function fetch($result = false)
	{
		if($result==false)
			return $this->lastResult->fetchArray(SQLITE3_ASSOC);
		else
			return $result->fetchArray(SQLITE3_ASSOC);
	}
	
	public function testEmpty()
	{
		$res = false;
		if($this->lastResult->fetchArray() == false)
			$res=true;
		$this->lastResult->reset();
		
		return $res;
	}
}
?>
