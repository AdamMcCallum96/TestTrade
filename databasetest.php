<?php

require_once('inc/config.inc.php');
require_once('inc/Entities/User.class.php');
require_once('inc/Utilities/PDOConnection.class.php');
require_once('inc/Utilities/UserDAO.php');

$user = new User();

$user->setUsername("mom");
$user->setPass("mompass");
$user->setEmail("mom");
var_dump($user);
var_dump(DB_USER);
UserDAO::initialize();

UserDAO::createUser($user);

$result = UserDAO::getUser("lol");
var_dump($result);





?>