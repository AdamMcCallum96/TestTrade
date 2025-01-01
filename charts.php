<?php

require_once("inc/config.inc.php");
require_once("inc/Utilities/PageFunctionality.class.php");
require_once("inc/Utilities/PDOConnection.class.php");

require_once("inc/Utilities/StockGraphsDAO.php");
require_once("inc/Utilities/StockGraphsTickersDAO.php");
require_once("inc/Utilities/StockAPIManager.class.php");
require_once("inc/Utilities/GraphPage.class.php");
require_once("inc/Utilities/StockDailyDAO.php");
require_once("inc/Utilities/QuickGraphHistoryDAO.php");
require_once("inc/Entities/QuickGraphHistory.class.php");

$data = array();

session_start();
$username = $_SESSION['user'];


QuickGraphHistoryDAO::initialize();
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


// if(isset($_GET['graphParams'])){
    
//     $res = json_decode($_GET['graphParams']);
//     $stockIDArray = array("CGX.TRT","TSLA");;
    
// }






//$result[] = StockAPIManager::getStockDaily("CGX.TRT");

//var_dump($result);

//var_dump($lol)
StockDailyDAO::initialize();

PageFunctionality::nav();
PageFunctionality::quickGraphDescription();
PageFunctionality::tradeSearchBar();




if(isset($_GET['search'])){
    //add the ticker to the query for the graph
    PageFunctionality::addSearchQuery($_GET['search']);
}
PageFunctionality::tradeSearchResult();




if(isset($_GET['graphParams'])){
    
    $res = json_decode($_GET['graphParams']);
    $stockIDArray = $res;

    if(isset($_GET['searchHistory'])){
        //insert param into the database
        $QGH = new QuickGraphHistory();
        $QGH->setUser_id($_SESSION['user']);
        $QGH->setHistoryText($_GET['graphParams']);

        QuickGraphHistoryDAO::createQuickGraphHistory($QGH);
        //go to database, if more than 5 records for the use
        //Delete the number of records by date

    }

    var_dump($stockIDArray);
    if(!$stockIDArray[0] == false){
        for($i = 0; $i < count($stockIDArray); $i++){
            $data[] = StockAPIManager::getStockDaily($stockIDArray[$i], true);
            // var_dump($data);
            // $data = array();
            // $data[] = StockDailyDAO::getStockDaily($stockIDArray[$i]);
            // var_dump($data);
        }
        //xdebug_info();
        
        // $data[] = StockDailyDAO::getStockDaily($stockIDArray[1]);
        
        //var_dump($result);
        $dates = StockDailyDAO::getDatesDistinctFromStocks($stockIDArray);
        
        
        for($x = 0; $x < count($data); $x ++){
            $stockArray = $data[$x];
            for($i = 0; $i < count($stockArray); $i++){
                $data[$x][$i] = $stockArray[$i]->jsonSerialize();
            }
        }
        $colours = ["#FF0000",'#008800',"#00c1ff","#ffd500","#dc00ff 
        "];
    
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

        

    } 
    
    $user = $_SESSION['user'];
       
        $result = QuickGraphHistoryDAO::getRecent($user);
        
        var_dump($result);
        PageFunctionality::quickGraphHistory($result);

    
}




// $gp = new GraphPage($data, $dates,$colours, "default","graphid1", $stockIDArray);
// // $gp.initGraphManager()
// // $gp.addGraph();
// $lol = "nice";
?>
<!-- <div style="width: 50%"> -->
<?php
// $gp->initGraphManager($lol);
// $gp->addGraph($data, $dates, $colours, "default","lol", $stockIDArray);
// $gp->showGraph();

// $gp->addGraph($data, $dates, $colours, "slider","lol",$stockIDArray);
// $gp->showGraph();


?>
<!-- </div> -->

<?php




?>