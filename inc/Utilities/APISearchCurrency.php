<?php


require_once('../config.inc.php');
require_once('../Entities/Currency.class.php');
require_once('PDOConnection.class.php');
require_once("CurrencyDAO.php");

$wordSearched = $_POST['currencySearch'];
$url = "";
CurrencyDAO::initialize();

$currencies = CurrencyDAO::getCurrenciesLike($wordSearched,$wordSearched,$wordSearched,$wordSearched);
var_dump("lol");
$htmlString ='<table class="searchTable">';
foreach($currencies as $currency){

    $htmlString = $htmlString . '<div class="searchRow"><div class="searchItem">';
    $htmlString = $htmlString . '<tr><td class="searchTableItem"><a class="searchItemText" href="'.$url.'?search='.$currency->getCurrencyCode().'">'.$currency->getCurrencyName() .'</a></td>';
    $htmlString = $htmlString .  '</div>';
    $htmlString = $htmlString . '<div class="searchItem">';
    $htmlString = $htmlString . '<td class="searchTableItem"><p class="searchItemText">'.$currency->getCurrencyCode() .'</p></td>';
    $htmlString = $htmlString .  '</div>';

}
$htmlString = $htmlString . "</table>";


echo $htmlString;

?>