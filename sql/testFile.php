
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
Class UserAccountTransactionDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('UserAccountTransaction');
    }	
static function createUserAccountTransaction(UserAccountTransaction $class){
		$sql = 'INSERT INTO UserAccountTransaction (user_id, currencyCode, transactionType, amount)
	VALUES (:user_id, :currencyCode, :transactionType, :amount)';
		self::$database->query($sql);
		self::$database->bind(':user_id', $class->getUser_id());
		self::$database->bind(':currencyCode', $class->getCurrencyCode());
		self::$database->bind(':transactionType', $class->getTransactionType());
		self::$database->bind(':amount', $class->getAmount());
		self::$database->execute();
	}
}
?>
<?php
Class CurrencyConversionDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('CurrencyConversion');
    }	
static function createCurrencyConversion(CurrencyConversion $class){
		$sql = 'INSERT INTO CurrencyConversion (conversionID, user_id, initialType, resultingType, initialValue, resultingValue, fee, conversionTime, );)
	VALUES (:conversionID, :user_id, :initialType, :resultingType, :initialValue, :resultingValue, :fee, :conversionTime, :);)';
		self::$database->query($sql);
		self::$database->bind(':conversionID', $class->getConversionID());
		self::$database->bind(':user_id', $class->getUser_id());
		self::$database->bind(':initialType', $class->getInitialType());
		self::$database->bind(':resultingType', $class->getResultingType());
		self::$database->bind(':initialValue', $class->getInitialValue());
		self::$database->bind(':resultingValue', $class->getResultingValue());
		self::$database->bind(':fee', $class->getFee());
		self::$database->bind(':conversionTime', $class->getConversionTime());
		self::$database->bind(':);', $class->get);());
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
		$sql = 'INSERT INTO UserStockBought (stockBoughtID, stockID, userID, price, quantity, timeBought, finalized, boughtTime)
	VALUES (:stockBoughtID, :stockID, :userID, :price, :quantity, :timeBought, :finalized, :boughtTime)';
		self::$database->query($sql);
		self::$database->bind(':stockBoughtID', $class->getStockBoughtID());
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':price', $class->getPrice());
		self::$database->bind(':quantity', $class->getQuantity());
		self::$database->bind(':timeBought', $class->getTimeBought());
		self::$database->bind(':finalized', $class->getFinalized());
		self::$database->bind(':boughtTime', $class->getBoughtTime());
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
		$sql = 'INSERT INTO UserStockSold (stockSoldID, stockID, userID, price, quantity, timeSold, finalized, soldTime)
	VALUES (:stockSoldID, :stockID, :userID, :price, :quantity, :timeSold, :finalized, :soldTime)';
		self::$database->query($sql);
		self::$database->bind(':stockSoldID', $class->getStockSoldID());
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':price', $class->getPrice());
		self::$database->bind(':quantity', $class->getQuantity());
		self::$database->bind(':timeSold', $class->getTimeSold());
		self::$database->bind(':finalized', $class->getFinalized());
		self::$database->bind(':soldTime', $class->getSoldTime());
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
		$sql = 'INSERT INTO UserStockTotals (stockID, userID, boughtPriceAvg, soldPriceAvg, boughtPriceTotal, soldPriceTotal, boughtQuantity, soldQuantity)
	VALUES (:stockID, :userID, :boughtPriceAvg, :soldPriceAvg, :boughtPriceTotal, :soldPriceTotal, :boughtQuantity, :soldQuantity)';
		self::$database->query($sql);
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':boughtPriceAvg', $class->getBoughtPriceAvg());
		self::$database->bind(':soldPriceAvg', $class->getSoldPriceAvg());
		self::$database->bind(':boughtPriceTotal', $class->getBoughtPriceTotal());
		self::$database->bind(':soldPriceTotal', $class->getSoldPriceTotal());
		self::$database->bind(':boughtQuantity', $class->getBoughtQuantity());
		self::$database->bind(':soldQuantity', $class->getSoldQuantity());
		self::$database->execute();
	}
}
?>
<?php
Class StockOrderDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('StockOrder');
    }	
static function createStockOrder(StockOrder $class){
		$sql = 'INSERT INTO StockOrder (stockID, userID, orderType, quantity, soldTime, ))
	VALUES (:stockID, :userID, :orderType, :quantity, :soldTime, :))';
		self::$database->query($sql);
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':orderType', $class->getOrderType());
		self::$database->bind(':quantity', $class->getQuantity());
		self::$database->bind(':soldTime', $class->getSoldTime());
		self::$database->bind(':)', $class->get)());
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
Class OrderDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('Order');
    }	
static function createOrder(Order $class){
		$sql = 'INSERT INTO Order (ID, stockID, userID, currencyCode, totalQProposed, totalQFilled, orderStatus, tradeAction, tradeType, tradePeriod, placedTime)
	VALUES (:ID, :stockID, :userID, :currencyCode, :totalQProposed, :totalQFilled, :orderStatus, :tradeAction, :tradeType, :tradePeriod, :placedTime)';
		self::$database->query($sql);
		self::$database->bind(':ID', $class->getID());
		self::$database->bind(':stockID', $class->getStockID());
		self::$database->bind(':userID', $class->getUserID());
		self::$database->bind(':currencyCode', $class->getCurrencyCode());
		self::$database->bind(':totalQProposed', $class->getTotalQProposed());
		self::$database->bind(':totalQFilled', $class->getTotalQFilled());
		self::$database->bind(':orderStatus', $class->getOrderStatus());
		self::$database->bind(':tradeAction', $class->getTradeAction());
		self::$database->bind(':tradeType', $class->getTradeType());
		self::$database->bind(':tradePeriod', $class->getTradePeriod());
		self::$database->bind(':placedTime', $class->getPlacedTime());
		self::$database->execute();
	}
}
?>
<?php
Class OrderFilledDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('OrderFilled');
    }	
static function createOrderFilled(OrderFilled $class){
		$sql = 'INSERT INTO OrderFilled (fillID, stockOrderID, quantityFilled, sharePrice, totalPrice, fillTime)
	VALUES (:fillID, :stockOrderID, :quantityFilled, :sharePrice, :totalPrice, :fillTime)';
		self::$database->query($sql);
		self::$database->bind(':fillID', $class->getFillID());
		self::$database->bind(':stockOrderID', $class->getStockOrderID());
		self::$database->bind(':quantityFilled', $class->getQuantityFilled());
		self::$database->bind(':sharePrice', $class->getSharePrice());
		self::$database->bind(':totalPrice', $class->getTotalPrice());
		self::$database->bind(':fillTime', $class->getFillTime());
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
		$sql = 'INSERT INTO StockGraphs (user_id, graphID, graphTickers, graphName, graphType, graphCustomTime, graphStartDate, graphEndDate)
	VALUES (:user_id, :graphID, :graphTickers, :graphName, :graphType, :graphCustomTime, :graphStartDate, :graphEndDate)';
		self::$database->query($sql);
		self::$database->bind(':user_id', $class->getUser_id());
		self::$database->bind(':graphID', $class->getGraphID());
		self::$database->bind(':graphTickers', $class->getGraphTickers());
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
<?php
Class QuickGraphHistoryDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('QuickGraphHistory');
    }	
static function createQuickGraphHistory(QuickGraphHistory $class){
		$sql = 'INSERT INTO QuickGraphHistory (history_id, user_id, historyText)
	VALUES (:history_id, :user_id, :historyText)';
		self::$database->query($sql);
		self::$database->bind(':history_id', $class->getHistory_id());
		self::$database->bind(':user_id', $class->getUser_id());
		self::$database->bind(':historyText', $class->getHistoryText());
		self::$database->execute();
	}
}
?>