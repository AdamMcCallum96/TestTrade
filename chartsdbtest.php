<?php

require_once("inc/config.inc.php");
require_once("inc/utilities/PDOConnection.class.php");
require_once("inc/utilities/StockDAO.php");
require_once("inc/utilities/StockDailyDAO.php");
require_once("inc/utilities/StockAPIManager.class.php");


//$startTime = new DateTime("now");

StockDailyDAO::initialize();
StockDAO::initialize();

// $startTime = microtime(true);
// $result = StockAPIManager::getStockDaily("GF",false);
// $currentTime = microtime(true);
// var_dump($currentTime - $startTime);

StockDailyDAO::deleteStockDaily("GF");
StockDAO::deleteStock("GF");

$startTime = microtime(true);
$result = StockAPIManager::getStockDaily("GF",true);
$currentTime = microtime(true);
var_dump($currentTime - $startTime);

StockDailyDAO::deleteStockDaily("GF");
$startTime = microtime(true);
$result = StockAPIManager::getStockDaily("GF",true);
$currentTime = microtime(true);
var_dump($currentTime - $startTime);

// StockDailyDAO::deleteStockDaily("GF");
// StockDAO::deleteStock("GF");




// var_dump($currentTime - $startTime);
// var_dump($result);
//var_dump($currentTime->getTimeStamp() - $startTime->getTimeStamp());



?>