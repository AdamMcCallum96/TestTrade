<?php

require_once('PDOConnection.class.php');
require_once('StockDailyDAO.php');

require_once('inc/Entities/StockDaily.class.php');
require_once('inc/Entities/Stock.class.php');
require_once('inc/Utilities/StockDailyDAO.php');
require_once('inc/Utilities/StockDAO.php');

class StockAPIManager {
    
    
    static function getStockDaily($stockID, $test){

        $startTime = microtime(true);
        StockDailyDAO::initialize();
        StockDAO::initialize();
        $stockExists = StockAPIManager::getStock($stockID);
        $stockInfo = StockDAO::getStock($stockID);
        // var_dump($stockInfo);
        file_put_contents("inc/Logs/errorlog.txt", "lol what is that");
        file_put_contents("inc/Logs/error.txt", "test1");

        //Return UTC +or- 0012
        $timezone= $stockInfo->getStockTimezone();
        $isPositive = true;
        $splitBy = "+";
        $UTC_Time = explode($splitBy, $timezone);

        if(sizeOf($UTC_Time) == 1){
            $isPositive = false;
            $splitBy = "-";
            $UTC_Time = explode($splitBy, $timezone);
        }
       
        $tz = new DateTimeZone("UTC");
        $localTime = new DateTime("now", $tz);
       
        $timestamp = strtotime($localTime->format('Y-m-d H:i:s'));
        $localTimeStamp = $timestamp - (intval($UTC_Time[1]) * 60 * 60);
        $localTime = date('Y-m-d H:i:s',$localTimeStamp);
        
        $stockFetch = StockDailyDAO::getStockDaily($stockID);

        // $stock = StockDailyDAO::getStockDailyDate($stockID,date('Y-m-d'));
        $stock1 = StockDailyDAO::getStockDailyDate($stockID,date('Y-m-d', $localTimeStamp));
        // var_dump($stockID,date('Y-m-d'));
        // var_dump($stockID,date('Y-m-d', $localTimeStamp));
        // var_dump(!$stock);
        // var_dump(!$stock1);
        // var_dump($stock);
        // var_dump($stock1);
        //Get the local date and add the closing time to it
        $localCloseTime = strtotime(date('Y-m-d', $localTimeStamp).$closeTime =$stockInfo->getStockMarketClose());
            
  
        $tz = new DateTimeZone("UTC");
        


        //$fileLog = fopen("../Logs/errorlog.txt","w");
        $fileLog = fopen("inc/Logs/errorlog.txt","w");
        $endTime = microtime(true);
        // var_dump("IN FUNCTION TIME1");
        // var_dump($endTime - $startTime);
        $startTime = microtime(true);
        
        /**localtime greater than stock close time**/
        if((/**$stockExists == True && $localTimeStamp > $localCloseTime) || (**/!$stockFetch)){
            //Check if we already have today inserted if not insert it

            // $stock1 = StockDailyDAO::getStockDailyDate($stockID,date('Y-m-d', $localTimeStamp));
            //Empty stocks so must inserts
            // var_dump("STOCCKKKKK: ". $stock1);
            if(!$stock1){
                var_dump("DATE STOCK NOT RETURN");
                // fwrite($fileLog, "Empty Stock");

                $result = file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_DAILY_ADJUSTED&symbol=".$stockID."&outputsize=full&apikey=".APIKEY);
                $phpObject = json_decode($result);
                
                $property = 'Time Series (Daily)';
                //Specifically get data in Time Series Daily only excludes 'Meta Data'
                $timeSeriesData = $phpObject->{$property};
                $timeSeriesData = (array)$timeSeriesData;
                //Push the date key onto the the array
                foreach($timeSeriesData as $key => $value){
                    $value = (array)$value;
                    $timeSeriesData[$key] = array_values($value);
                    array_push($timeSeriesData[$key], $key);
         
                }
                //Converts the array numerically
                $timeSeriesData = array_values($timeSeriesData);
                $xData = [];
                $yData = [];
                $count = count($timeSeriesData);
                for ($x=0; $x < $count; $x++){
                    $yData[] = $timeSeriesData[$count - 1 - $x][4];
                    $xData[] = $timeSeriesData[$count - 1 - $x][8];
        
                }
                $date = $xData;
                $value = $yData;
                //$test = true;
                $endTime = microtime(true);
                // var_dump("IN FUNCTION TIME2");
                // var_dump($endTime - $startTime);
                
                if($test == true){
                    StockDailyDAO::createAllStockDaily($date, $value, $stockID);
                } else {
                    for($x=0; $x < count($date); $x++){
                        $stockDaily = new StockDaily;
                        $stockDaily->setStockID($stockID);
                        $stockDaily->setStockDate($date[$x]);
                        $stockDaily->setStockValue($value[$x]);
                        try{
                        $execute = StockDailyDAO::createStockDaily($stockDaily);
                        } catch(Exception $e){
                            // echo 'Exception Message: ', $e->getMessage();
                        }
                       
                    }
                }

                
                $result = [$date,$value];
            }
            else {
                
                $result = StockDailyDAO::getStockDaily($stockID);

                $date = [];
                $value = [];
                foreach($result as $stockDaily){
                   $date[] = $stockDaily->getStockDate();
                   $value[] = $stockDaily->getStockValue();
                }
                $result = [$date,$value];
            }
    
            
            
        } else {
            // fwrite($fileLog, $stock);
            $result = StockDailyDAO::getStockDaily($stockID);
            $date = [];
            $value = [];
                foreach($result as $stockDaily){
                   $date[] = $stockDaily->getStockDate();
                   $value[] = $stockDaily->getStockValue();
                }
            $result = [$date,$value];
            // var_dump($result);
        }
        fclose($fileLog);
       
        // var_dump($result);
        //properties [][0]= open, high, low, close, volume, date
        // file_put_contents("inc/Logs/error.txt", "test3");
        // file_put_contents("inc/Logs/error.txt", serialize($result));
        if($test == true){
            return StockDailyDAO::getStockDaily($stockID);
        }
        return $result;
    }

    //Returns a stock if $returnStock is true
    static function getStock($id, $returnStock = FALSE){
            
            //Returns true if the stock exists
            StockDAO::initialize();
            $stockExists = StockDAO::getStock($id);
            if(!$stockExists){
                // var_dump($id);
                $result = file_get_contents('https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords='.$id.'&apikey='.APIKEY);
                $result = json_decode($result);
                // var_dump($result);
                // var_dump($result->bestMatches[0]->{'1. symbol'});
                // var_dump("YOUR MOM");
                if($id == $result->bestMatches[0]->{'1. symbol'}){
                    //we have success
                    $data = (array)$result->bestMatches[0];
                    $data = array_values($data);
                    
                    $stock = new Stock(); 
                    $stock->setID($data[0]);
                    $stock->setStockName($data[1]);
                    $stock->setStockRegion($data[3]);
                    $stock->setStockMarketOpen($data[4]);
                    $stock->setStockMarketClose($data[5]);
                    $stock->setStockTimezone($data[6]);
                    $stock->setStockCurrency($data[7]);
                    
                    StockDAO::createStock($stock);
                    $doesExist = StockDAO::getStock($id);
                    
                    if(!$doesExist){
                        return false;
                    } else {
                        if($returnStock == TRUE){
                            return $doesExist;
                        } else {
                            return true;
                        }
                        
                    }
                }
               
               
             
                //var_dump($result->bestMatches[0]->);
                // var_dump(gettype($result));
            } else {
                // var_dump($result);
                // var_dump(gettype($result));
                if($returnStock == TRUE){
                    return $stockExists;
                } else {
                    return true;
                }
            }
    }


    static function getCurrentStockPrice($ticker){
        //ONLY WORKS FOR UNITED STATES STOCKS
        //$URL = "https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY";
        $URL = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY";
        $URL = $URL . "&symbol=".$ticker;
        //$URL = $URL . "&interval="."1min";
        $URL = $URL . "&apikey=". APIKEY;
        // $URL = $URL . "&outputsize="."compact";

        // var_dump($URL); 
        $result = file_get_contents($URL);
        //var_dump($result);
        $result = json_decode($result);
        // var_dump($result);

        $prop = 'Time Series (Daily)';
        $result = $result->$prop;

        $result = (array)$result;
        $result = array_values($result)[0];
        $prop1 = '4. close';
        // var_dump($result);
        //var_dump($result->$prop1);
        //var_dump($result->$prop);

        // foreach($timeSeriesData as $key => $value){
        //     $value = (array)$value;
        //     $timeSeriesData[$key] = array_values($value);
        //     array_push($timeSeriesData[$key], $key);
 
        // }
        return $result->$prop1;

    }

    
    
}



?>