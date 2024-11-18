<?php
require_once('inc/config.inc.php');
require_once('inc/Entities/User.class.php');

require_once('inc/Utilities/PDOConnection.class.php');
require_once('inc/Utilities/UserDAO.php');
require_once('inc/Utilities/GeneralPage.class.php');
$usernameEntered = "";
$usernameExists = False;
$user = new User();
if(!empty($_POST)){

    
    $user->setUsername($_POST['username']);
    $user->setEmail($_POST['email']);
    $user->setPass($_POST['password']);
    $user->setFirstName($_POST['fn']);
    $user->setLastName($_POST['ln']);
    $user->setDateOfBirth($_POST['bday']);
    $usernameEntered = $_POST['email'];
    UserDAO::initialize();
    $result = UserDAO::getUser($user->getEmail());
    var_dump($result);
    if($result != False){
        $usernameExists = True;
        //Account already exists therefore notify the user regarding this matter
        //Sorry this account
    } else {
        //Create the account

        UserDAO::createUser($user);
        $host = $_SERVER['HTTP_HOST'];
        $em = $user->getEmail();
        header("Location: https://$host/mockstock/signupDirect.php?email=$em");
    }

    var_dump($result);

    // var_dump($_SERVER['HTTP_HOST']);
    // var_dump( $_SERVER['PHP_SELF']);
    // var_dump(dirname());
    

    //Validate it
    


}

GeneralPage::header();
GeneralPage::nav();
$usernameEntered = 'The email '.$usernameEntered ." has already been taken. Please try again.";
GeneralPage::signup($usernameExists, $usernameEntered, $user);
GeneralPage::footer();
// var_dump($_POST['mail']);
// var_dump($_POST);


?>