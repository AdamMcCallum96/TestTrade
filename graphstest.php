<?php

require_once("inc/config.inc.php");
require_once("inc/Utilities/PageFunctionality.class.php");
require_once("inc/Utilities/PDOConnection.class.php");
require_once("inc/Utilities/StockAPIManager.class.php");
require_once("inc/Utilities/GraphPage.class.php");
require_once("inc/Utilities/StockDailyDAO.php");

$data = array();

//$result[] = StockAPIManager::getStockDaily("CGX.TRT");

//var_dump($result);

//var_dump($lol)
StockDailyDAO::initialize();

$stockIDArray = array("CGX.TRT","TSLA");

for($i = 0; $i < count($stockIDArray); $i++){

    $data[] = StockDailyDAO::getStockDaily($stockIDArray[$i]);
}
//xdebug_info();

// $data[] = StockDailyDAO::getStockDaily($stockIDArray[1]);

//var_dump($result);
$dates = StockDailyDAO::getDatesDistinctFromStocks($stockIDArray);
// var_dump($dateTest);


//var_dump($data);
for($x = 0; $x < count($data); $x ++){
    $stockArray = $data[$x];
    for($i = 0; $i < count($stockArray); $i++){
        $data[$x][$i] = $stockArray[$i]->jsonSerialize();
    }
}

$colours = ["#FF0000",'#008800',"#0000FF"];
//$colours = ["#FF0000",'#00800',"#0000FF"];
$gp = new GraphPage($data, $dates, $colours);


PageFunctionality::nav();
// var_dump($gp->getData());
$gp->displayGraph();


//var_dump($data);
var_dump(json_encode($data));


//Get th





?>