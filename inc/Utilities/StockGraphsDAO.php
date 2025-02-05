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

static function getCount($id){
	$sql = "SELECT count(*)
	from
	(SELECT * FROM StockGraphs WHERE user_id = :user_id
	) countTable";


	self::$database->query($sql);
	self::$database->bind(':user_id',$id);
	self::$database->execute();
	return self::$database->singleResult();
	
}

	static function getRecent($user){
		$sql = "SELECT *from StockGraphs WHERE
        user_id = :user_id order by graphID DESC limit 5";

        self::$database->query($sql);
        self::$database->bind(':user_id', $user);
        self::$database->execute();

        return self::$database->resultSet();

	}
	static function selectStockGraphsFromUser($username){

		// try {
		$sql = "SELECT * FROM StockGraphs WHERE user_id = :user_id";
		self::$database->query($sql);
		self::$database->bind(':user_id', $username);
		self::$database->execute();
		return self::$database->resultSet();
		// } catch (Exception $e){
		// 	return 0;
		// }
		
	}
}
?>