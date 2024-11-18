<?php

require_once('inc/config.inc.php');
require_once('inc/Entities/User.class.php');
require_once('inc/Utilities/PDOConnection.class.php');
require_once('inc/Utilities/StockDAO.php');

// $service = new PDOConnection();

// $service->PDOConnection("Stock");


$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASS;

try {
  $conn = new PDO("mysql:host=$servername;dbname=".DB_NAME, $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}



?>