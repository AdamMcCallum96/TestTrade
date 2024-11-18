<?php
Class UserStockBoughtDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('UserStockBought');
    }	
static function createUserStockBought(UserStockBought $class){
		$sql = 'INSERT INTO UserStockBought (stockID, userID, price, quantity, timeBought, finalized)
	VALUES (:stockID, :userID, :price, :quantity, :timeBought, :finalized)';
		self::$database->query($sql);
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':price', $class->getPrice());
		self::$database->bind(':quantity', $class->getQuantity());
		self::$database->bind(':timeBought', $class->getTimeBought());
		self::$database->bind(':finalized', $class->getFinalized());
		self::$database->execute();
	}

    static function getAll(){
        $sql = 'SELECT * FROM UserStockBought';
        self::$database->query($sql);
        self::$database->execute();
        return self::$database->resultSet();
    }

    static function insert(UserStockBought $obj){
        $sql = "INSERT INTO UserStockBought Values (:stockID, :userID, :price, :quantity, :timeBought, :finalized);";

        self::$database->query($sql);
        self::$database->bind(':stockID', $obj->getStockID());
        self::$database->bind(':userID', $obj->getUserID());
        self::$database->bind(':price', $obj->getPrice());
        self::$database->bind(':quantity', $obj->getQuantity());
        self::$database->bind(':timeBought', $obj->getTimeSold());
        self::$database->bind(':finalized', $obj->getFinalized());
        self::$databse->execute();
    }
    
}


?>