<?php

require_once('inc/Utilities/GeneralPage.class.php');

$result = $_GET['email'];

GeneralPage::header();
GeneralPage::nav();
GeneralPage::signUpDirect($result);
GeneralPage::footer();


?>