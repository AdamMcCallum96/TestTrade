<?php

class StockDailyDAO {
    private static $database;

    static function initialize() {
        self::$database = new PDOConnection('StockDaily');
    }

    static function createStockDaily(StockDaily $stock){
        $sql = 'INSERT INTO StockDaily (stockID, stockDate, stockValue)
        VALUES (:stockID, :stockDate, :stockValue)';

        self::$database->query($sql);
        self::$database->bind(':stockID', $stock->getStockID());
        self::$database->bind(':stockDate', $stock->getStockDate());
        self::$database->bind(':stockValue', $stock->getStockValue());
        self::$database->execute();
    }

    static function getStockDaily($id) {
        $sql = 'SELECT * FROM StockDaily WHERE stockID = :id ORDER BY stockDate ASC';
        self::$database->query($sql);
        self::$database->bind(':id',$id);
        self::$database->execute();
        return self::$database->resultSet();
    }
    static function getStockDailyDate($id, $date) {
        $sql = 'SELECT * FROM StockDaily WHERE stockID = :id AND stockDate = :sDate';
       
        self::$database->query($sql);
        self::$database->bind(':id',$id);
        self::$database->bind(':sDate',$date);
        self::$database->execute();
        return self::$database->resultSet();
        //return self::$database->singleResult();
    }

    static function updateStockDaily(StockDaily $stock) {
        $sql = 'UPDATE StockDaily
        SET stockDate = :stockDate,
        SET stockValue = :stockValue,
        WHERE stockID = :stockID';

        self::$database->query($sql);
        self::$database->bind(':stockDate', $stock->getStockDate());
        self::$database->bind(':stockValue', $stock->getStockValue());
        self::$databse->execute();
    }

    static function deleteStockDaily($stockID) {
        $sql = 'DELETE FROM StockDaily WHERE stockID = :stockID';
        self::$database->query($sql);
        self::$database->bind(':stockID', $stockID);
        self::$database->execute();
    }

    static function getDatesDistinctFromStocks($stockIDs){

        //$sql = "SELECT DISTINCT stockDate FROM STOCKDAILY WHERE ";
        $sql = "SELECT DISTINCT stockDate FROM STOCKDAILY WHERE stockID IN( ";
        $endString = " ) order by StockDate";
        $count = 0;
        $stockStrings = array();
        foreach($stockIDs as $stock){
            
            if($stock != $stockIDs[count($stockIDs)-1]) {
                // $sql = $sql. "stockID = :stock".$count." OR ";
                $sql = $sql . ":stock".$count.",";
            } else {
                //last stock
                // $sql = $sql. "stockID = :stock".$count;
                $sql = $sql . ":stock".$count;
            }
           
            $count += 1;
        }
        $sql = $sql . $endString;
        $count = 0;
        // var_dump($sql);
        self::$database->query($sql);
        foreach($stockIDs as $stock){
            $s = ":stock".$count;
            self::$database->bind($s,$stock);
            $count += 1;
        }
        self::$database->execute();
        return self::$database->resultSetCustom();
    }
    
}

?>