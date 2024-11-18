<?php

require_once('inc/config.inc.php');
require_once('inc/Utilities/PageFunctionality.class.php');
require_once('inc/Utilities/PDOConnection.class.php');
require_once('inc/Utilities/UserAccountBalanceDAO.php');

session_start();

if(!isset($_SESSION['user'])){
    //GET OUT OF THE PAGE, user not logged in
}

PageFunctionality::nav();
PageFunctionality::includeJavascript();


if(isset($_GET['action'])) {

    UserAccountBalanceDAO::initialize();
   
    switch($_GET['action']){
        case "withdrawl":
            //UserAccountBalanceDAO::
        break;
        
        case "deposit":
            
            PageFunctionality::manageCurrency();
        break;
        
        case "convert":
            
            
        break;
    }
} else {
    
    //Select menu shows up
    PageFunctionality::manageCurrencyOptions();

}




?>