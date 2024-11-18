

<?php

require_once('../config.inc.php');
$search = $_POST['search_Bar'];
$url = "";
if(isset($_POST['previous_URL'])){
    $url = $_POST['previous_URL'];
}

$start = "https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=";

//$end = "&apikey=RMBE8204LUUMD845";
$end = "&apikey=".APIKEY;
$apiString = $start.$search.$end;
$result = file_get_contents($start.$search.$end);
// $result= "working lol";
//var_dump($result);
$result = json_decode($result);

$property = 'bestMatches';
$properties = $result->{$property};


$properties = (array)$properties;

foreach($properties as $key => $value){
    #var_dump($key, $value);

    $value = (array)$value;
    $properties[$key] = array_values($value);
    array_push($properties[$key], $key);
    
    
}
//0 Symbol, 1 Company name, 2 Type
$htmlString = "";
// foreach($properties as $property){
//     $htmlString = $htmlString . '<ul>';
//     // $htmlString = $htmlString . '<li><a href="'.'/mockstock/stocksearch.php'.'?search='.$property[0].'">'.$property[1] .'</a></li>';
//     $htmlString = $htmlString . '<li><a href="'.$url.'?search='.$property[0].'">'.$property[1] .'</a></li>';
//     $htmlString = $htmlString . '<li>'.$property[0] .'</li>';
//     $htmlString = $htmlString . '</ul>';
// }

$htmlString = '<table class="searchTable">';
foreach($properties as $property){
    $htmlString = $htmlString . '<div class="searchRow"><div class="searchItem">';
    $htmlString = $htmlString . '<tr><td class="searchTableItem"><a class="searchItemText" href="'.$url.'?search='.$property[0].'">'.$property[1] .'</a></td>';
    $htmlString = $htmlString .  '</div>';
    $htmlString = $htmlString . '<div class="searchItem">';
    $htmlString = $htmlString . '<td class="searchTableItem"><p class="searchItemText">'.$property[0] .'</p></td>';
    $htmlString = $htmlString .  '</div>';
    $htmlString = $htmlString . '<div class="searchItem">';
    $htmlString = $htmlString . '<td class="searchTableItem"><p class="searchItemText">'.$property[7] .'</p></td></tr>';
    $htmlString = $htmlString .  '</div></div>';
}

$htmlString = $htmlString . "</table>";
//var_dump($);
echo $htmlString;

?>