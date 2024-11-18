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

static function getAllFromUser($id) {
	$sql = "SELECT * FROM UserAccountBalance WHERE user_id = :user_id";
	self::$database->query($sql);
	self::$database->bind(':user_id',$id);
	self::$database->execute();
	return self::$database->resultSet();
}
}
?>