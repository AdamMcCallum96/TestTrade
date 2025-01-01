<?php
require_once("../../inc/config.inc.php");
$stockID = $argc[1];
$result = file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=".$stockID."&outputsize=full&apikey=".APIKEY);
var_dump($result);
echo $result;
echo "LOL";



?>