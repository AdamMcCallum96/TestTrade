<?php
Class OrderDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('StockOrders');
    }	
static function createOrder(StockOrders $class){
		$sql = 'INSERT INTO StockOrders (ID, stockID, userID, currencyCode, totalQProposed, totalQFilled, orderStatus, tradeAction, tradeType, tradePeriod, placedTime)
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