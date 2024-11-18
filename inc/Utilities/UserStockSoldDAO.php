<?php
Class UserStockSoldDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('UserStockSold');
    }	
static function createUserStockSold(UserStockSold $class){
		$sql = 'INSERT INTO UserStockSold (stockID, userID, price, quantity, timeSold, finalized)
	VALUES (:stockID, :userID, :price, :quantity, :timeSold, :finalized)';
		self::$database->query($sql);
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':price', $class->getPrice());
		self::$database->bind(':quantity', $class->getQuantity());
		self::$database->bind(':timeSold', $class->getTimeSold());
		self::$database->bind(':finalized', $class->getFinalized());
		self::$database->execute();
	}

    static function getAll(){
        $sql = 'SELECT * FROM UserStockSold';
        self::$database->query($sql);
        self::$database->execute();
        return self::$database->resultSet();
    }

    static function insert(UserStockSold $obj){
        $sql = "INSERT INTO UserStockSold Values (:stockID, :userID, :price, :quantity, :timeSold, :finalized);";

        self::$database->query($sql);
        self::$database->bind(':stockID', $obj->getStockID());
        self::$database->bind(':userID', $obj->getUserID());
        self::$database->bind(':price', $obj->getPrice());
        self::$database->bind(':quantity', $obj->getQuantity());
        self::$database->bind(':timeSold', $obj->getTimeSold());
        self::$database->bind(':finalized', $obj->getFinalized());
        self::$databse->execute();
    }
}
?>

?>