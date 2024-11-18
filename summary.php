<?php

require_once('inc/config.inc.php');
require_once('inc/Utilities/PageFunctionality.class.php');


require_once('inc/Entities/User.class.php');
require_once('inc/Entities/Currency.class.php');
require_once('inc/Entities/UserAccountBalance.class.php');
require_once('inc/Entities/UserStock.class.php');
require_once('inc/Entities/UserStockTotals.class.php');
require_once('inc/Entities/Stock.class.php');

require_once("inc/Utilities/PDOConnection.class.php");
require_once('inc/Utilities/StockDAO.php');
require_once('inc/Utilities/UserStockTotalsDAO.php');

session_start();
var_dump($_SESSION['user']);
if(!isset($_SESSION['user'])){
    var_dump("USER NOT LOGGED IN");
}

PageFunctionality::nav();
PageFunctionality::summary();
UserStockTotalsDAO::initialize();
StockDAO::initialize();
if((isset($_GET['UI'])) && ($_GET['UI'] == 'currency')){
    var_dump("test1");
    

    PageFunctionality::summaryCurrency();
} else {
    //Create the DB queries
    //Get the total quantity
    //Get the total sold
    //If total quantity sold = quantity purchased finalize 
    //them to get rid of the purchase
    
    $result = UserStockTotalsDAO::getAllByUser($_SESSION['user']);
    var_dump($result);
    //$result = StockDAO::getStockFromStockTotals($_SESSION['user']);
    $result = UserStockTotalsDAO::joinStocksByUser($_SESSION['user']);
    var_dump($result);
    //var_dump($result[0]->stockID);
    PageFunctionality::summaryPortfolio($result);
}

// PageFunctionality::summaryCurrency();
PageFunctionality::footer();




?>