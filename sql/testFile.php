
<?php
Class DAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('');
    }	
static function create( $class){
		$sql = 'INSERT INTO  (
	VALUES (';
		self::$database->query($sql);
		self::$database->execute();
	}
}
?>
<?php
Class UserDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('User');
    }	
static function createUser(User $class){
		$sql = 'INSERT INTO User (email, username, pass, firstName, lastName, dateOfBirth)
	VALUES (:email, :username, :pass, :firstName, :lastName, :dateOfBirth)';
		self::$database->query($sql);
		self::$database->bind(':email', $class->getEmail());
		self::$database->bind(':username', $class->getUsername());
		self::$database->bind(':pass', $class->getPass());
		self::$database->bind(':firstName', $class->getFirstName());
		self::$database->bind(':lastName', $class->getLastName());
		self::$database->bind(':dateOfBirth', $class->getDateOfBirth());
		self::$database->execute();
	}
}
?>
<?php
Class StockDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('Stock');
    }	
static function createStock(Stock $class){
		$sql = 'INSERT INTO Stock (ID, stockName, stockRegion, stockMarketOpen, stockMarketClose, stockTimezone, stockCurrency)
	VALUES (:ID, :stockName, :stockRegion, :stockMarketOpen, :stockMarketClose, :stockTimezone, :stockCurrency)';
		self::$database->query($sql);
		self::$database->bind(':ID', $class->getID());
		self::$database->bind(':stockName', $class->getStockName());
		self::$database->bind(':stockRegion', $class->getStockRegion());
		self::$database->bind(':stockMarketOpen', $class->getStockMarketOpen());
		self::$database->bind(':stockMarketClose', $class->getStockMarketClose());
		self::$database->bind(':stockTimezone', $class->getStockTimezone());
		self::$database->bind(':stockCurrency', $class->getStockCurrency());
		self::$database->execute();
	}
}
?>
<?php
Class CurrencyDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('Currency');
    }	
static function createCurrency(Currency $class){
		$sql = 'INSERT INTO Currency (currencyCode, currencyName)
	VALUES (:currencyCode, :currencyName)';
		self::$database->query($sql);
		self::$database->bind(':currencyCode', $class->getCurrencyCode());
		self::$database->bind(':currencyName', $class->getCurrencyName());
		self::$database->execute();
	}
}
?>
<?php
Class UserAccountBalanceDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('UserAccountBalance');
    }	
static function createUserAccountBalance(UserAccountBalance $class){
		$sql = 'INSERT INTO UserAccountBalance (user_id, currencyCode, balance)
	VALUES (:user_id, :currencyCode, :balance)';
		self::$database->query($sql);
		self::$database->bind(':user_id', $class->getUser_id());
		self::$database->bind(':currencyCode', $class->getCurrencyCode());
		self::$database->bind(':balance', $class->getBalance());
		self::$database->execute();
	}
}
?>
<?php
Class UserStockBoughtDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('UserStockBought');
    }	
static function createUserStockBought(UserStockBought $class){
		$sql = 'INSERT INTO UserStockBought (stockBoughtID, stockID, userID, price, quantity, timePurchased, finalized)
	VALUES (:stockBoughtID, :stockID, :userID, :price, :quantity, :timePurchased, :finalized)';
		self::$database->query($sql);
		self::$database->bind(':stockBoughtID', $class->getStockBoughtID());
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':price', $class->getPrice());
		self::$database->bind(':quantity', $class->getQuantity());
		self::$database->bind(':timePurchased', $class->getTimePurchased());
		self::$database->bind(':finalized', $class->getFinalized());
		self::$database->execute();
	}
}
?>
<?php
Class UserStockSoldDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('UserStockSold');
    }	
static function createUserStockSold(UserStockSold $class){
		$sql = 'INSERT INTO UserStockSold (stockSoldID, stockID, userID, price, quantity, timeSold, finalized)
	VALUES (:stockSoldID, :stockID, :userID, :price, :quantity, :timeSold, :finalized)';
		self::$database->query($sql);
		self::$database->bind(':stockSoldID', $class->getStockSoldID());
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':price', $class->getPrice());
		self::$database->bind(':quantity', $class->getQuantity());
		self::$database->bind(':timeSold', $class->getTimeSold());
		self::$database->bind(':finalized', $class->getFinalized());
		self::$database->execute();
	}
}
?>
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
}
?>
<?php
Class UserStockDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('UserStock');
    }	
static function createUserStock(UserStock $class){
		$sql = 'INSERT INTO UserStock (ID, stockID, userID, currencyCode, quantityBought, quantitySold, purchasePrice, priceTotal, datePurchased, finalized)
	VALUES (:ID, :stockID, :userID, :currencyCode, :quantityBought, :quantitySold, :purchasePrice, :priceTotal, :datePurchased, :finalized)';
		self::$database->query($sql);
		self::$database->bind(':ID', $class->getID());
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':currencyCode', $class->getCurrencyCode());
		self::$database->bind(':quantityBought', $class->getQuantityBought());
		self::$database->bind(':quantitySold', $class->getQuantitySold());
		self::$database->bind(':purchasePrice', $class->getPurchasePrice());
		self::$database->bind(':priceTotal', $class->getPriceTotal());
		self::$database->bind(':datePurchased', $class->getDatePurchased());
		self::$database->bind(':finalized', $class->getFinalized());
		self::$database->execute();
	}
}
?>
<?php
Class StockDailyDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('StockDaily');
    }	
static function createStockDaily(StockDaily $class){
		$sql = 'INSERT INTO StockDaily (stockID, stockDate, stockValue)
	VALUES (:stockID, :stockDate, :stockValue)';
		self::$database->query($sql);
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':stockDate', $class->getStockDate());
		self::$database->bind(':stockValue', $class->getStockValue());
		self::$database->execute();
	}
}
?>
<?php
Class StockRealTimeDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('StockRealTime');
    }	
static function createStockRealTime(StockRealTime $class){
		$sql = 'INSERT INTO StockRealTime (stockID, stockTime, stockValue)
	VALUES (:stockID, :stockTime, :stockValue)';
		self::$database->query($sql);
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':stockTime', $class->getStockTime());
		self::$database->bind(':stockValue', $class->getStockValue());
		self::$database->execute();
	}
}
?>
<?php
Class StockFavourtiesDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('StockFavourties');
    }	
static function createStockFavourties(StockFavourties $class){
		$sql = 'INSERT INTO StockFavourties (stock_id, user_id)
	VALUES (:stock_id, :user_id)';
		self::$database->query($sql);
		self::$database->bind(':stock_id', $class->getStock_id());
		self::$database->bind(':user_id', $class->getUser_id());
		self::$database->execute();
	}
}
?>
<?php
Class StockGraphsDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('StockGraphs');
    }	
static function createStockGraphs(StockGraphs $class){
		$sql = 'INSERT INTO StockGraphs (user_id, graphID, graphName, graphType, graphCustomTime, graphStartDate, graphEndDate)
	VALUES (:user_id, :graphID, :graphName, :graphType, :graphCustomTime, :graphStartDate, :graphEndDate)';
		self::$database->query($sql);
		self::$database->bind(':user_id', $class->getUser_id());
		self::$database->bind(':graphID', $class->getGraphID());
		self::$database->bind(':graphName', $class->getGraphName());
		self::$database->bind(':graphType', $class->getGraphType());
		self::$database->bind(':graphCustomTime', $class->getGraphCustomTime());
		self::$database->bind(':graphStartDate', $class->getGraphStartDate());
		self::$database->bind(':graphEndDate', $class->getGraphEndDate());
		self::$database->execute();
	}
}
?>
<?php
Class StockGraphsTickersDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('StockGraphsTickers');
    }	
static function createStockGraphsTickers(StockGraphsTickers $class){
		$sql = 'INSERT INTO StockGraphsTickers (user_id, graph_id, stock_id)
	VALUES (:user_id, :graph_id, :stock_id)';
		self::$database->query($sql);
		self::$database->bind(':user_id', $class->getUser_id());
		self::$database->bind(':graph_id', $class->getGraph_id());
		self::$database->bind(':stock_id', $class->getStock_id());
		self::$database->execute();
	}
}
?>