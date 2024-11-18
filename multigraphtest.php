<?php

require_once('inc/Utilities/PageMultiGraph.class.php');


$data1 = array(11,12,13,14,15);
$time1 = array("t11","t12","t13","t14","t15");
$data2 = array(21,22,23,24,25);
$time2 = array("t21","t22","t23","t24","t25");

$MG = new MultiGraph();

$MG->loadData($time1,$data1);
var_dump($MG);
$MG->loadData($time2,$data2);
var_dump($MG);

[$time, $data] = $MG->getData();

var_dump($time);
var_dump($data);

var_dump($time[0]);
var_dump($time[1]);




?>