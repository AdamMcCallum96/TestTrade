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
// $stockIDArray = array("TSLA");
$stockIDArray = array("CGX.TRT","TSLA");
// $stockIDArray = array("BCE.TRT","RCI-B.TRT","T.TRT","CGX.TRT","TSLA");
// $stockIDArray = array("CGX.TRT","TSLA");

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

//Graph page in theory holds all the graphs for the entire page.
//You use the graph page constructor to simply
//Give your page graph functionalities.
//Use the displayGraph method or displayAllGraphs
//to show a graph or all graphs in the order in which
//they were added to the page.
//This has the power to give you a lot of flexibililty.
//If you're only showing one graph it gives you extra
//flexibility with regard to what content can be displayed inbetween
//different graphs/datasets
$gp = new GraphPage($data, $dates,$colours, "default","graphid1");
$gp.initGraphManager()
// $gp.addGraph();

PageFunctionality::nav();
// var_dump($gp->getData());
$gp->initJSProperties();
$gp->displayGraph();
$gl = new GraphPage($data, $dates, $colours, "slider","graphid2");
// $gl->displayGraph();


// $gs = new GraphPage($data, $dates, $colours, "slider","graphid2");
// $gs->displayGraph();

// $gl = new GraphPage($data, $dates, $colours, "default","graphid2");
// $gl->displayGraph();

//var_dump($data);
var_dump(json_encode($data));


//Get th




?>