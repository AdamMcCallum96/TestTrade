<?php

require_once('../../inc/config.inc.php');
require_once('../../inc/Utilities/PDOConnection.class.php');
require_once('../../inc/Utilities/UserStockTotalsDAO.php');
require_once('../../inc/Utilities/UserStockSoldDAO.php');
require_once('../../inc/Utilities/UserStockBoughtDAO.php');
require_once('../../inc/Utilities/StockDAO.php');

//ENTITIES

require_once('../../inc/Entities/UserStockBought.class.php');
require_once('../../inc/Entities/UserStockSold.class.php');
require_once('../../inc/Entities/UserStockTotals.class.php');


UserStockSoldDAO::initialize();
UserStockBoughtDAO::initialize();
UserStockTotalsDAO::initialize();


$stockBought = new UserStockBought();
$stockBought->setStockBoughtID('lol');
$stockBought->setStockID('WFG.TRT');
$stockBought->setUserID('adammccallum96@gmail.com');
$stockBought->setPrice(50);
$stockBought->setQuantity(50);
$stockBought->setTimeBought(time());
$stockBought->setFinalized(0);


 //UserStockBoughtDAO::CreateUserStockBought($stockBought);


$stockSold = new UserStockSold();
$stockSold->setStockID('WFG.TRT');
$stockSold->setUserID('adammccallum96@gmail.com');
$stockSold->setPrice(55);
$stockSold->setQuantity(30);
$stockSold->setTimeSold(time());
$stockSold->setFinalized(0);

 //UserStockSoldDAO::CreateUserStockSold($stockSold);

$result = UserStockBoughtDAO::getAll();
var_dump($result);

$result = UserStockSoldDAO::getAll();
var_dump($result);

$totals = new UserStockTotals();

$totals->setStockID("WFG.TRT");
$totals->setUserID("adammccallum96@gmail.com");
$totals->setBoughtPriceAvg(10);
$totals->setSoldPriceAvg(12);
$totals->setBoughtPriceTotal(100);
$totals->setSoldPriceTotal(120);

//UserStockTotalsDAO::createUserStockTotals($totals);

UserStockTotalsDAO::updateTotals('adammccallum96@gmail.com','LOAR');
UserStockTotalsDAO::updateTotals('adammccallum96@gmail.com','CGX.TRT');
UserStockTotalsDAO::updateTotals('adammccallum96@gmail.com','WFG.TRT');

$result = UserStockTotalsDAO::getAll();
var_dump($result);



?>