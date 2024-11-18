<?php

require_once('inc/config.inc.php');
require_once('inc/Utilities/GeneralPage.class.php');
require_once('inc/Utilities/PageGraph.class.php');
require_once('inc/Utilities/PageMultiGraph.class.php');
require_once('inc/Utilities/StockAPIManager.class.php');

GeneralPage::header();
GeneralPage::nav();

$ticker = "AAPL";
if(isset($_GET['search'])){
    $ticker = $_GET['search'];
}
var_dump($ticker);
$MG = new PageMultiGraph();

//Load the datafirst for the page
[$date,$stockPrice] = StockAPIManager::getStockDaily("IFP.TRT");
$MG->loadData($date, $stockPrice);
[$date,$stockPrice] = StockAPIManager::getStockDaily("WFG.TRT");
$MG->loadData($date, $stockPrice);
// var_dump($date);
// var_dump($stockPrice);
[$date,$stockPrice] = StockAPIManager::getStockDaily("CFP.TRT");
$MG->loadData($date, $stockPrice);

//Display the page
$MG->displayGraph();



//[$date,$stockPrice] = StockAPIManager::getStockDaily($ticker);
//PageGraph::displayGraph($date,$stockPrice);
GeneralPage::footer();


?>