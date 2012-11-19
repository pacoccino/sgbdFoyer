<?php


interface dbInterface
{
  public function executeSqlFile($file);
  public function connect();
  
}

include "mysqlInterface.php";

switch($config->sqlImpl){
    case "mysql":
        $dbInter = new mysqlInterface();
        break;
    default:
        //$dbInter = new mysqlInterface();
        $dbInter = new mysqlInterface();
}

?>
