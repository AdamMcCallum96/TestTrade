<?php

$dbFile = file_get_contents("sql/mockstock.sql");


$table = explode("CREATE TABLE",$dbFile);
$createdFile =fopen("sql/testFile.php","w");
//$createdFile =fopen("sql/created.php","w");

for($i = 0; $i < count($table); $i++){
    //echo "Value of line: ". $table[$i];

    $currentString = "";
    $className = "";
    $columns = array();
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
                
            } else {
                $columns[] = $sqlItems[0];
                //$getters[] = "public function get".ucfirst($sqlItems[0]).'(){return $this->'.$sqlItems[0].';}';
                //$setters[] = "public function set".ucfirst($sqlItems[0]).'($'.$sqlItems[0].'){$this->'.$sqlItems[0].'= $'.$sqlItems[0].';}';
            }
            //echo "\n";
            // echo $sqlItems[$x];
           
        } else {
            break;
        }


        
    }
    
    fwrite($createdFile, "\n<?php");
   
    $cn = "\nClass ".$className."DAO {";
    fwrite($createdFile, $cn);

    $initData = "\n\tprivate static \$database;

    static function initialize() {
        self::\$database = new PDOConnection('".$className."');
    }";
    
    // fwrite($createdFile, )
    fwrite($createdFile, $initData);

    //Create function
    $lastColumn = "";
    $columnString = "(";
    
    
    for($z = 0; $z < count($columns); $z++){

        if($z == count($columns) - 1){
            $columnString = $columnString.$columns[$z].")";
        } else {
            $columnString = $columnString.$columns[$z].", ";
        }
    }

    $columnString = $columnString."\n\tVALUES (";
    
    for($z = 0; $z < count($columns); $z++){

        if($z == count($columns) - 1){
            $columnString = $columnString.":".$columns[$z].")";
        } else {
            $columnString = $columnString.":".$columns[$z].", ";
        }
    
    }

    $queryCreateString = "";

    $queryCreateString = "\n\t\tself::\$database->query(\$sql);";
    for($z=0; $z < count($columns);$z++){
        $queryCreateString = $queryCreateString ."\n\t\tself::\$database->bind(':".$columns[$z]."', \$class->get".ucfirst($columns[$z])."());";

    }
    
    $queryCreateString = $queryCreateString . "\n\t\tself::\$database->execute();";
    $createFunction = "\n\t\t\$sql = 'INSERT INTO ".$className." ".$columnString."';";


    $queryCreateString = "\t\nstatic function create".$className."(".$className." \$class){".$createFunction.$queryCreateString;
    fwrite($createdFile, $queryCreateString);
    fwrite($createdFile, "\n\t}");


    
        // foreach($classProperties as $value){

    //     $value = "\n".$value;
    //     fwrite($createdFile,$value);
    // }
    // foreach($getters as $value){
    //     $value = "\n".$value;
    //     fwrite($createdFile, $value);
    // }
    // foreach($setters as $value){
    //     $value = "\n".$value;
    //     fwrite($createdFile, $value);
    // }
    fwrite($createdFile, "\n}");
    fwrite($createdFile, "\n?>");
    
}


fclose($createdFile);


?>