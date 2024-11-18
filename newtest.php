<?php

require_once("inc/config.inc.php");
// $result = file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=wfg.trt&outputsize=full&apikey=".APIKEY, 0, null, null);
// $goodString = json_decode($result);
//$goodString = json_encode($goodString, JSON_PRETTY_PRINT);
// header('Content-type: application/json');
// echo json_encode($goodString, JSON_PRETTY_PRINT);


$testArray = array('orange','apple','banana');
$count = count($testArray);
for($i = 0; $i < $count; $i++){
    var_dump($testArray[$count - 1 - $i]);

    
}

var_dump(count($testArray));
?>