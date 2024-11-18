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

	static function getCurrenciesLike($s1, $s2, $s3, $s4){

		$s1 = $s1 . "%";
		$s2 = $s2 . "%";
		$s3 = "%". $s3 . "%";
		$s4 = "%". $s4 . "%";
		$sql = "SELECT * FROM (Select * from currency
		where currencyCode like  :s1 OR currencyName like :s2
		UNION
		select * from currency
		where currencyCode like :s3 OR currencyName like :s4 ) as table3
		limit 10";

		self::$database->query($sql);
		self::$database->bind(':s1', $s1);
		self::$database->bind(':s2', $s2);
		self::$database->bind(':s3', $s3);
		self::$database->bind(':s4', $s4);
		self::$database->execute();
		return self::$database->resultSet();

	}
}


?>