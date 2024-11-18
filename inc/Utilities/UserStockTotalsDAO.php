<?php
Class UserStockTotalsDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('UserStockTotals');
    }	
static function createUserStockTotals(UserStockTotals $class){
		$sql = 'INSERT INTO UserStockTotals (stockID, userID, boughtPriceAvg, soldPriceAvg, boughtPriceTotal, soldPriceTotal)
	VALUES (:stockID, :userID, :boughtPriceAvg, :soldPriceAvg, :boughtPriceTotal, :soldPriceTotal)';
		self::$database->query($sql);
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':boughtPriceAvg', $class->getBoughtPriceAvg());
		self::$database->bind(':soldPriceAvg', $class->getSoldPriceAvg());
		self::$database->bind(':boughtPriceTotal', $class->getBoughtPriceTotal());
		self::$database->bind(':soldPriceTotal', $class->getSoldPriceTotal());
		self::$database->execute();
	}

    static function updateTotals($userID, $stockID){
        self::updateBoughtAvg($userID, $stockID);
        self::updateSoldAvg($userID, $stockID);
        self::updateBoughtTotal($userID, $stockID);
        self::updateSoldTotal($userID, $stockID);
        self::updateSoldQuantity($userID, $stockID);
        self::updateBoughtQuantity($userID, $stockID);
    }

    static function updateBoughtAvg($userID, $stockID){
        $sql = "UPDATE UserStockTotals
        SET boughtPriceAvg = (SELECT sum(price * quantity )/ sum(quantity)
                            FROM UserStockBought
                            WHERE stockID = :stockID AND userID = :userID)
        WHERE stockID = :stockID AND userID = :userID;";
        
        
        self::$database->query($sql);
        self::$database->bind(':userID', $userID);
        self::$database->bind(':stockID', $stockID);
        self::$database->execute();
    }

    static function updateSoldAvg($userID, $stockID){
       
        $sql = "UPDATE UserStockTotals
        SET soldPriceAvg = (SELECT sum(price * quantity )/ sum(quantity)
                            FROM UserStockSold
                            WHERE stockID = :stockID AND userID = :userID)
        WHERE stockID = :stockID AND userID = :userID";
        
        
        self::$database->query($sql);
        self::$database->bind(':userID', $userID);
        self::$database->bind(':stockID', $stockID);
        self::$database->execute();
    }

    static function updateBoughtTotal($userID, $stockID){
        $sql = "UPDATE UserStockTotals
        SET boughtPriceTotal = (SELECT sum(price * quantity)
                            FROM UserStockBought
                            WHERE stockID = :stockID AND userID = :userID)
        WHERE stockID = :stockID AND userID = :userID";
        
        
        self::$database->query($sql);
        self::$database->bind(':userID', $userID);
        self::$database->bind(':stockID', $stockID);
        self::$database->execute();
    }

    static function updateSoldTotal($userID, $stockID){
        $sql = "UPDATE UserStockTotals
        SET soldPriceTotal = (SELECT sum(price * quantity)
                            FROM UserStockSold
                            WHERE stockID = :stockID AND userID = :userID)
        WHERE stockID = :stockID AND userID = :userID";
        
        
        self::$database->query($sql);
        self::$database->bind(':userID', $userID);
        self::$database->bind(':stockID', $stockID);
        self::$database->execute();
    }

    static function updateBoughtQuantity($userID, $stockID){

        $sql = "UPDATE UserStockTotals
        SET boughtQuantity = (SELECT sum(quantity)
                            FROM UserStockBought
                            WHERE stockID = :stockID AND userID = :userID)
        WHERE stockID = :stockID AND userID = :userID";
        self::$database->query($sql);
        self::$database->bind(':userID', $userID);
        self::$database->bind(':stockID', $stockID);
        self::$database->execute();
    }

    static function updateSoldQuantity($userID, $stockID){

        $sql = "UPDATE UserStockTotals
        SET soldQuantity = (SELECT sum(quantity)
                            FROM UserStockSold
                            WHERE stockID = :stockID AND userID = :userID)
        WHERE stockID = :stockID AND userID = :userID";
        self::$database->query($sql);
        self::$database->bind(':userID', $userID);
        self::$database->bind(':stockID', $stockID);
        self::$database->execute();
    }

    static function resetTotals() {

    }

    static function getAllByUser($userID){
        $sql = "SELECT * FROM UserStockTotals WHERE userID = :userID";
        
        self::$database->query($sql);
        self::$database->bind(':userID', $userID);
        self::$database->execute();
        return self::$database->resultSet();

    }

    static function getAll(){
        $SQL = 'SELECT * FROM UserStockTotals';
        self::$database->query($SQL);
        self::$database->execute();
        return self::$database->resultSet();
    }

    static function joinStocksByUser($userID){
        // $sql = "SELECT * FROM UserStockTotals
        // INNER JOIN Stock
        // ON UserStockTotals.stockID = Stock.ID
        // WHERE UserStockTotals.userID = :userID";

        // $sql = "SELECT * FROM UserStockTotals
        // INNER JOIN Stock
        // ON UserStockTotals.stockID = Stock.ID INNER JOIN
        // StockDaily
        // ON UserStockTotals.stockID = StockDaily.stockID
        // WHERE UserStockTotals.userID = :userID";

        //WHERE StockDaily.stockDate = MAX(StockDaily.stockDate)
        //SELECT stockValue, stockID, max(StockDaily.stockDate) as maxDate

        // $sql = "SELECT * FROM UserStockTotals, SD.stockValue, SD.coolDate
        // INNER JOIN Stock
        // ON UserStockTotals.stockID = Stock.ID 
        //     INNER JOIN ( 
        //         SELECT stockValue, stockID, min(stockDate) as coolDate
        //         FROM StockDaily
        //         GROUP BY stockID
        //         ORDER BY stockDate ASC
                
        //     ) SD
        
        // ON UserStockTotals.stockID = StockDaily.stockID
        // WHERE UserStockTotals.userID = :userID";
        

        // $sql = "SELECT * FROM Stock
        // INNER JOIN UserStockTotals
        // ON  Stock.ID = UserStockTotals.stockID";
        // WHERE UserStockTotals.userID = :userID";

        //$sql = "SELECT sd.stockID, sd.stockDate, sd.stockValue
        $sql = "SELECT * FROM UserStockTotals
         INNER JOIN Stock
         ON UserStockTotals.stockID = Stock.ID

        
        
        INNER JOIN (SELECT sd.stockID, sd.stockDate, sd.stockValue
        FROM stockDaily as sd
        JOIN (SELECT stockID as stockIDTest, stockValue as realValue, max(stockDate) as stock_date
            from stockDaily
            GROUP BY stockID
            
            ) as allDates
        ON sd.stockDate = allDates.stock_date
        AND sd.stockID = allDates.stockIDTest) as sTable
        ON(UserStockTotals.stockID = sTable.stockID)
        WHERE UserStockTotals.userID = :userID";
        

        self::$database->query($sql);
        self::$database->bind(":userID", $userID);
        // self::$database->bind(":stockID", $stockID);
        self::$database->execute();
        return self::$database->resultSetCustom();
    }
}
?>