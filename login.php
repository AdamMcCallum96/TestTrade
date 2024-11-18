<?php

require_once('inc/config.inc.php');
require_once('inc/Utilities/GeneralPage.class.php');
require_once('inc/Entities/User.class.php');
require_once('inc/Utilities/LoginAuthentication.class.php');

require_once('inc/Utilities/PDOConnection.class.php');
require_once('inc/Utilities/UserDAO.php');
$error = "";
if(!empty($_GET['email'])){

    $email = $_GET['email'];
    $pass = $_GET['pass'];
    var_dump($pass);
    var_dump($email);
    $result = LoginAuthentication::Login($email, $pass);
    if($result != false){
        $user = $result->getEmail();
        session_start();
        $_SESSION['user'] = $user;
        header("Location: trade.php");
    } else {
        $error = "Incorrect username or password, please try again.";
    }
    

} 


//$email = $_GET['email'];

// var_dump($email);
GeneralPage::header();
GeneralPage::nav();
GeneralPage::login($error);

GeneralPage::footer();




?>