<?php

class sqliteInterface implements genericInterface {
	private $base;
	
	public function __construct($config) {
		$dbname=$config->databaseName;
		$this->base=new SQLiteDatabase($dbname, 0666, $err);
		if ($err)
			die("SQLite error.");
 
		echo "SQLite connected.";
	}
    public function test()
    {
        echo "sqlite test";
    }
    
    public function connect() {
		
	}
    
    public function executeSqlFile($file)
    {
    }
}
?>
