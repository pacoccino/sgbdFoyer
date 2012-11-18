<?php

include "mysqlInterface.php";

interface dbInterface
{
  public function executeSqlFile($file);
}

switch($config->sqlImpl){
    case "mysql":
        $dbInter = new mysqlInterface();
        break;
    default:
        $dbInter = new mysqlInterface();
}
    
?>