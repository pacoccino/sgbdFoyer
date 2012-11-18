<?php

class mysqlInterface implements dbInterface {
    public function test()
    {
        echo "mysql started";
    }
    
    public function executeSqlFile($file)
    {
    }
}