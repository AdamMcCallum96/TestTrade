<?php

class StockDAO {
    private static $database;

    static function initialize() {
        self::$database = new PDOConnection('Stock');
        // var_dump("STOCKDAO RAN");
        // var_dump(self::$database);
    }

    static function createStock(Stock $stock) {
        $sql = 'INSERT INTO Stock (ID, stockName, stockRegion, stockMarketOpen, 
        stockMarketClose, stockTimezone, stockCurrency) 
        VALUES (:ID, :stockName, :stockRegion, :stockMarketOpen, 
        :stockMarketClose, :stockTimezone, :stockCurrency)';

        self::$database->query($sql);
        self::$database->bind(':ID',$stock->getID());
        self::$database->bind(':stockName',$stock->getStockName());
        self::$database->bind(':stockRegion',$stock->getStockRegion());
        self::$database->bind(':stockMarketOpen',$stock->getStockMarketOpen());
        self::$database->bind(':stockMarketClose',$stock->getStockMarketClose());
        self::$database->bind(':stockTimezone',$stock->getStockTimezone());
        self::$database->bind(':stockCurrency', $stock->getStockCurrency());
        self::$database->execute();
    }

    static function getStock($id) {
   

       
        $sql = 'SELECT * FROM Stock WHERE ID = :id';

        self::$database->query($sql);
        self::$database->bind(':id',$id);
        self::$database->execute();
        return self::$database->singleResult();
       
    }

    static function updateStock(Stock $stock) {
        $sql = 'UPDATE Stock 
        SET stockName = :stockName,
        SET stockSymbol = :stockSymbol,
        WHERE ID = :id';

        self::$database->query($sql);
        self::$database->bind(':stockName', $stock->getStockName());
        self::$database->bind(':stockSymbol', $stock->getStockSymbol());
        self::$database->execute();
    }

    static function deleteStock($id) {
        $sql = 'DELETE FROM Stock WHERE ID = :id';

        self::$database->query($sql);
        self::$database->bind(':id',$id);
        self::$database->execute();
    }

    static function getStockFromStockTotals($userID){
        $sql = "SELECT * FROM Stock
        INNER JOIN UserStockTotals
        ON  Stock.ID = UserStockTotals.stockID";
        // WHERE UserStockTotals.userID = :userID";

        self::$database->query($sql);
        // self::$database->bind(":userID", $userID);
        // self::$database->bind(":stockID", $stockID);
        self::$database->execute();
        return self::$database->ResultSet();
    }
}




?>