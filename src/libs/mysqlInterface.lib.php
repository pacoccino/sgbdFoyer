<?php

class mysqlInterface implements genericInterface {
	private $base;
	public $lastResult;
	
	public function __construct($config) {
		$mysqlDB=$config->mysqlDB;
		
		try {
		$this->base = new mysqli($mysqlDB->host, $mysqlDB->user, $mysqlDB->password, $mysqlDB->db);
		} catch(Exception $e)
		{
			die($e);
		}
		//$this->base=new SQLiteDatabase($dbname, 0666, $err);

		
	}
    public function test()
    {
        echo "mysql test";
    }
	

	public function query($query, $debug=false) {
		$return = $this->base->query($query);
		$this->lastResult=$return;
		if($debug == true && $return == false)
			echo $this->base->error;
		return $return;
	}
    
    public function executeSqlFile($file)
    {
		$sqlbrut=file_get_contents($file);
		$this->base->multi_query($sqlbrut);
    }
    
    public function errorMsg()
    {
		return $this->base->error;
	}
	
	public function fetch($result = false)
	{
		if(result==false)
			return $this->lastResult->fetch_assoc();
		else
			return $result->fetch_assoc();
	}
	
	public function testEmpty()
	{
		return $this->lastResult->numrows == 0;
	}
	
}
?>
