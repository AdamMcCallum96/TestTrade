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