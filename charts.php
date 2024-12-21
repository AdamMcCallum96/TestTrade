<?php

require_once("inc/config.inc.php");
require_once("inc/Utilities/PageFunctionality.class.php");
require_once("inc/Utilities/PDOConnection.class.php");

require_once("inc/Utilities/StockGraphsDAO.php");
require_once("inc/Utilities/StockGraphsTickersDAO.php");
require_once("inc/Utilities/StockAPIManager.class.php");
require_once("inc/Utilities/GraphPage.class.php");
require_once("inc/Utilities/StockDailyDAO.php");

$data = array();

session_start();
$username = $_SESSION['user'];



StockGraphsDAO::initialize();

// $result = StockGraphsDAO::selectStockGraphsFromUser($username);

//Quick Chart:

//Search bar and selection menu to find actual stocks

//Click the stocks to quickly add them to a visual query
//The visual quert simply shows a small list
//of stocks in a flex box like structure
//with a delete buttion next to them 
//Click the construct graph to make the graph
//with the desired stocks

//Quick chart history to quickly

    //search bar if you just want to see a stock charted
if(empty($result)){
    //Show the your list page contain graph names and add graph button
} else {

}








//$result[] = StockAPIManager::getStockDaily("CGX.TRT");

//var_dump($result);

//var_dump($lol)
StockDailyDAO::initialize();
// $stockIDArray = array("TSLA");
$stockIDArray = array("CGX.TRT","TSLA");
// $stockIDArray = array("BCE.TRT","RCI-B.TRT","T.TRT","CGX.TRT","TSLA");
// $stockIDArray = array("BCE.TRT","RCI-B.TRT","T.TRT");
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

// for($n = 0; $n < count($stockIDArray); $n){
//     $stockIDArray[$n] = $stockIDArray[$n]->jsonSerialize();
// }
// $stockIDArray = $stockIDArray->jsonSerialize();
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
PageFunctionality::nav();
PageFunctionality::tradeSearchBar();
//PageFunctionality::addSearchQuery();
PageFunctionality::tradeSearchResult();

if(isset($_GET['search'])){
    //add the ticker to the query for the graph
    PageFunctionality::addSearchQuery($_GET['search']);
}

PageFunctionality::tradeSearchResult();
$gp = new GraphPage($data, $dates,$colours, "default","graphid1", $stockIDArray);
// $gp.initGraphManager()
// $gp.addGraph();
$lol = "nice";
?>
<!-- <div style="width: 50%"> -->
<?php
$gp->initGraphManager($lol);
$gp->addGraph($data, $dates, $colours, "default","lol", $stockIDArray);
$gp->showGraph();

$gp->addGraph($data, $dates, $colours, "slider","lol",$stockIDArray);
$gp->showGraph();


?>
<!-- </div> -->

<?php




?>