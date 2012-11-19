<?php

class mysqlInterface implements genericInterface {
	
	public function __construct($config) {
		
	}
    public function test()
    {
        echo "mysql started";
    }
    
    public function connect() {
		
	}
    
    public function executeSqlFile($file)
    {
    }
}
?>
