<?php

require_once("../../inc/config.inc.php");

// require_once("inc/config.inc.php");

$stock = "CGX.TRT";
exec("asynctest.php CGX.TRT", $output);
var_dump($output);

foreach($output as $lol){
    echo $lol;
}
//echo $output;



?>