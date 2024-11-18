<?php

require_once('inc/config.inc.php');
require_once('inc/Utilities/PageFunctionality.class.php');
require_once('inc/Utilities/PageMultiGraph.class.php');
require_once('inc/Utilities/StockAPIManager.class.php');
require_once('inc/Utilities/StockAPIManager.class.php');
// var_dump($_G)
PageFunctionality::nav();
PageFunctionality::tradeSearchBar();

session_start();
var_dump($_SERVER['HTTP_HOST']);
// var_dump($_SESSION['user']);

if(isset($_POST['stockQuantity'])){
    var_dump($_POST);
}

if(isset($_GET['search'])){
    $ticker = $_GET['search'];
    $MG = new PageMultiGraph();
    [$date,$stockPrice] = StockAPIManager::getStockDaily($ticker);
    $MG->loadData($date, $stockPrice);
    $tradeInfo = "";
    PageFunctionality::tradeSearchResult();
    $stockPrice = StockAPIManager::getCurrentStockPrice($ticker);
    //returns Stock.class.php entity
    $stock = StockAPIManager::getStock($ticker, TRUE);
    
    var_dump($stockPrice);
    PageFunctionality::tradeContent($MG, $stockPrice, $stock);
    var_dump($stock);
    var_dump($MG);
} else {
    PageFunctionality::tradeSearchResult();
    // PageFunctionality::tradeContent($graph, $tradeInfo);
    
}


// var_dump($_GET['search']);
// PageFunctionality::trade();
// var_dump($_GET['search']);









?>


