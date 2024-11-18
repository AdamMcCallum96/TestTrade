<?php

require_once('inc/Entities/User.class.php');
//$result = array('stockID','userID','quantityBought','quantitySold','purchasePrice','priceTotal','datePurchased');
$result = array('ID', 'stockName', 'stockRegion', 'stockMarketOpen',
 'stockMarketClose', 'stockTimezone', 'stockCurrency');

$getters = array();
$setters = array();
for($i = 0; $i < sizeof($result); $i++) {
    $getters[] = "public function get".ucfirst($result[$i]).'(){return $this->'.$result[$i].';}';
    $setters[] = "public function set".ucfirst($result[$i]).'($'.$result[$i].'){$this->'.$result[$i].'= $'.$result[$i].';}';
}
var_dump($getters);

foreach ($getters as $value){
    print("\n".$value);
}

foreach ($setters as $line){
    print("\n".$line);
}
$newUser = new User;
$classMethods = get_class_methods($newUser);

foreach ($classMethods as $method){
    print('\n'. $method);
}



?>