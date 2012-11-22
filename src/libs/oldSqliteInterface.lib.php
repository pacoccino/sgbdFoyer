<?php
class oldSqliteInterface {
	public $base;
	public $lastResult;
	
	public function __construct($config) {
		
		$dbname=$config->sqliteFile;
		try {
			$this->base= new SQLiteDatabase($dbname, 0666, $err);
		} catch(Exception $e)
		{
			die("Erreur :".$e);
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
			echo $this->errorMsg();
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
		return sqlite_error_string ($this->base->lastError());
	}
	
	public function fetch($result = false)
	{
		if($result==false)
			return $this->lastResult->fetch(SQLITE_ASSOC);
		else
			return $result->fetch(SQLITE_ASSOC);
	}
	
	public function testEmpty()
	{
		return ($this->lastResult->numRows() == 0);
	}
}
?>

