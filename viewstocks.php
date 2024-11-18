<?php

require_once('inc/config.inc.php');
require_once('inc/Utilities/GeneralPage.class.php');
require_once('inc/Utilities/PageMultiGraph.class.php');
require_once('inc/Utilities/StockAPIManager.class.php');

require_once('inc/Utilities/PDOConnection.class.php');


GeneralPage::header();
GeneralPage::nav();
$graph = new PageMultiGraph();

[$date,$stockPrice] = StockAPIManager::getStockDaily("ifp.trt");
$graph->loadData($date, $stockPrice);
// [$date,$stockPrice] = StockAPIManager::getStockDaily("wfg.trt");
// $graph->loadData($date, $stockPrice);
// var_dump($date);
// var_dump($stockPrice);
[$date,$stockPrice] = StockAPIManager::getStockDaily("cfp.trt");
$graph->loadData($date, $stockPrice);
// [$date,$stockPrice] = StockAPIManager::getStockDaily("zzz.trt");
// $graph->loadData($date, $stockPrice);
// [$date,$stockPrice] = StockAPIManager::getStockDaily("tsla");
// $graph->loadData($date, $stockPrice);
// [$date,$stockPrice] = StockAPIManager::getStockDaily("aapl");
// $graph->loadData($date, $stockPrice);
GeneralPage::generalContainer($graph);
GeneralPage::footer();



?>