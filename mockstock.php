<?php
require_once('inc/config.inc.php');
require_once('inc/Utilities/Page.class.php');
require_once('inc/Utilities/PageGraph.class.php');
require_once('inc/Utilities/StockAPIManager.class.php');
Page::header();
Page::body();
$start = hrtime(true);
// run your code...

//PREMIUM KEY
//LAGOC7QJ8T5O04UL

#$type = file_get_contents("https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=BTC&to_currency=CNY&apikey=demo");
// $type = file_get_contents("https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=BTC&to_currency=CNY&apikey=RMBE8204LUUMD845");
// print("This should print");
#$type2= file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=IBM&outputsize=full&apikey=RMBE8204LUUMD845");
//$type2= file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=CGX.TRT&outputsize=full&apikey=RMBE8204LUUMD845");
//$type2= file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=WFG.TRT&outputsize=full&apikey=RMBE8204LUUMD845");
$type2= file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=WFG.TRT&outputsize=full&apikey=".APIKEY);
// $type2= file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=IFP.TRT&outputsize=full&apikey=RMBE8204LUUMD845");
$type5 = file_get_contents("https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=ba&apikey=".APIKEY);
$type5 = json_decode($type5);

// var_dump($_GET['search']);

// var_dump($type5);
// $type4 = file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=IBM&apikey=demo");
// $type4 = json_decode($type4);
// var_dump($type4);
// print($type);
// print($type['1. From_Currency Code']);
// var_dump($type);
// var_dump($type[0]);
// $test = json_decode($type);
// var_dump($test);
// $property1 = 'Realtime Currency Exchange Rate';
// $property2 = '1. From_Currency Code';
// var_dump($test->{$property1}->{$property2});

 #var_dump($type2);
 $test1 = json_decode($type2);
 //var_dump($test1);
$i = 0;
 #foreach ($test1 as $value){
    
 #}
 var_dump($test1);
 $property = 'Time Series (Daily)';
 $properties = $test1->{$property};
 #var_dump($properties);
var_dump($properties);
$properties = (array)$properties;
#var_dump($properties)
#var_dump($properties)
foreach($properties as $key => $value){
    #var_dump($key, $value);

    $value = (array)$value;
    $properties[$key] = array_values($value);
    array_push($properties[$key], $key);
    
    
}
$properties = array_values($properties);
var_dump($properties);
$column = '1. open';
$xData = [];
$yData = [];
$trend = 'none';
$counter = 0;
// var_dump($properties);
for ($x=0; $x < count($properties); $x++){
   // if($counter < 500){
    $nextTrend = '';
    $currentValue = $properties[$x][0];
    
    if($x < count($properties) - 1){
        
        $nextValue = $properties[$x += 1][0];
        
        if($nextValue > $currentValue){
            $nextTrend = 'up';
        } else {
            $nextTrend ='down';
        }
        switch($trend) {
            case 'up';
               
                if($nextTrend == 'up'){
                    //skip it
                } else {
                    $yData[] = $properties[$x][0];
                    $xData[] = $properties[$x][5];
                    $trend = 'down';
                }
                break;
            case 'down';
               
                if($nextTrend == 'down'){
                    //skipt it
                } else {
                    $yData[] = $properties[$x][0];
                    $xData[] = $properties[$x][5];
                    $trend = 'up';
                }
                break;
            case 'none';
               
                if($nextValue > $currentValue){
                    $trend = 'up';
                } else {
                    $trend = 'down';
                }
                $yData[] = $properties[$x][0];
                $xData[] = $properties[$x][5];
                break;
        }
        
    } else {
        $yData[] = $properties[$x][0];
        $xData[] = $properties[$x][5];
    }
    
//}   $counter +=1;
   //$yData[] = $properties[$x][0];
    
}

$xData = [];
$yData = [];

for ($x=0; $x < count($properties); $x++){
    $yData[] = $properties[$x][FINANCEDATATYPE];
    $xData[] = $properties[$x][5];
}
#var_dump($xData);
#var_dump($properties->{$column});

#Page::testGraph($xData, $yData);
$xTest = [100,150,160,250,260,300,360];
$yTest = ["Friday","Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday"];
var_dump(json_encode($xTest, JSON_HEX_TAG));
if(isset($_GET['search'])){
    var_dump($_GET['search']);
    $query = $_GET['search'];
    [$xData, $yData] = StockAPIManager::getStockDaily($query);
    
    // $type2 = json_decode($type2);
}
// Page::testGraph($xTest, $yTest);
//   var_dump($xData);
//   var_dump($yData);
// Page::testGraph($xData, $yData);
PageGraph::displayGraph($xData, $yData);
Page::footer();

// var_dump($type2);

$request = $_SERVER['REQUEST_URI'];
var_dump($request);

require 'testtrade.html';

$end = hrtime(true);   

// echo ($end - $start);                // Nanoseconds
// echo ($end - $start) / 1000000;      // Milliseconds
$clockDif = ($end - $start) / 1000000000;
var_dump($clockDif);
?>

