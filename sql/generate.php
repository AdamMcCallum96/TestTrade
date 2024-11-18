<?php

$file = file_get_contents("sql/mockstock.sql");
// echo $file;
$table = explode("CREATE TABLE",$file);
$createdFile =fopen("sql/created.php","w");
$createdFile =fopen("sql/created.php","w");

for($i = 0; $i < count($table); $i++){
    //echo "Value of line: ". $table[$i];

    $currentString = "";
    $className = "";
    $getters = array();
    $setters = array();
    $classProperties = array();

    $data = "";
    $sqlTable = explode("\n",$table[$i]);

    for($x = 0; $x < count($sqlTable); $x++){
        
        if(trim($sqlTable[$x])== ""){
            break;
        }
        if($sqlTable[$x] != ""){
            $trimmed = trim($sqlTable[$x]);
            $sqlItems = explode(" ",$trimmed);
            var_dump($sqlItems);
            // echo $sqlItems[0];
            for($j = 0; $j < count($sqlItems); $j++){
                //echo $sqlItems[0];
            }
            if($x == 0) {
                $className = $sqlItems[0];
                $className = "\nClass ".$className." {";
            } else {
                $classProperties[] = "private $".$sqlItems[0].";";
                $getters[] = "public function get".ucfirst($sqlItems[0]).'(){return $this->'.$sqlItems[0].';}';
                $setters[] = "public function set".ucfirst($sqlItems[0]).'($'.$sqlItems[0].'){$this->'.$sqlItems[0].'= $'.$sqlItems[0].';}';
            }
            echo "\n";
            // echo $sqlItems[$x];
           
        } else {
            break;
        }
        
    }
    
    fwrite($createdFile, "\n<?php");
   
    fwrite($createdFile, $className);
    
    // fwrite($createdFile, )
    foreach($classProperties as $value){

        $value = "\n".$value;
        fwrite($createdFile,$value);
    }
    foreach($getters as $value){
        $value = "\n".$value;
        fwrite($createdFile, $value);
    }
    foreach($setters as $value){
        $value = "\n".$value;
        fwrite($createdFile, $value);
    }
    fwrite($createdFile, "\n}");
    fwrite($createdFile, "\n?>");
    
}


fclose($createdFile);
// var_dump($table);
?>