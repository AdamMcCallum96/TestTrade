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

static function getGraphsTickers($userID, $graphID){
	$sql = 'SELECT * FROM StockGraphTickers WHERE user_id = :userID && graph_id = :graph_id';


	self::$database->query($sql);
	self::$database->bind(':user_id', $userID);
	self::$database->bind(':graph_id', $graphID);
	self::$database->execute();
	return self::$database->resultSet();
}

static function deleteGraphTickers(){
	$sql = "DELETE * FROM StockGraphsTickers WHERE StockGraphTickers WHERE 
	user_id = :userID 
	&& graph_id = :graph_id
	&& stock_id = :stock_id";
	self::$database->query($sql);
	self::$database->bind(':user_id', $class->getUserID());
	self::$database->bind(':graph_id', $class->getGraphID());
	self::$database->bind(':stock_od', $class->getStockID());
	self::$database->execute();
	return self::$database->resultSet();
}

?>