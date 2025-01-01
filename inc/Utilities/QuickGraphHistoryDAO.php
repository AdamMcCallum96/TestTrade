<?php 
Class QuickGraphHistoryDAO {
	private static $database;

    static function initialize() {
        self::$database = new PDOConnection('QuickGraphHistory');
    }	
    static function createQuickGraphHistory(QuickGraphHistory $class){
            $sql = 'INSERT INTO QuickGraphHistory (user_id, historyText)
        VALUES (:user_id, :historyText)';
            self::$database->query($sql);
            self::$database->bind(':user_id', $class->getUser_id());
            self::$database->bind(':historyText', $class->getHistoryText());
            self::$database->execute();
    }

    static function getRecent($userID){
        $sql = "SELECT historyText from QuickGraphHistory WHERE
        user_id = :user_id order by history_id DESC limit 5";

        self::$database->query($sql);
        self::$database->bind(':user_id', $userID);
        self::$database->execute();

        return self::$database->resultSet();
    }
}

?>