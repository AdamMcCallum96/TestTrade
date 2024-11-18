<?php

require_once('inc/config.inc.php');
require_once('inc/Utilities/GeneralPage.class.php');
require_once('inc/Utilities/PageGraph.class.php');

require_once('inc/Utilities/StockAPIManager.class.php');

GeneralPage::header();
GeneralPage::nav();

$ticker = "AAPL";
if(isset($_GET['search'])){
    $ticker = $_GET['search'];
}
var_dump($ticker);
[$date,$stockPrice] = StockAPIManager::getStockDaily($ticker);
var_dump($date);
PageGraph::displayGraph($date,$stockPrice);
GeneralPage::footer();


?>