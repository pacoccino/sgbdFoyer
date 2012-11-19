<?php

interface genericInterface
{
	
	public function executeSqlFile($file);
	public function query($query);
	public function fetch($result);
    public function testEmpty();
}

?>
