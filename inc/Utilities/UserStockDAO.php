<?php

class UserStockDAO {
    
    private static $database;

    static function initialize() {
        self::$database = new PDOConnection('UserStock');
    }

    static function createUserStock(UserDAO $userDAO) {
        $sql = 'INSERT INTO UserStock (stockID, userID, quantityBought, quantitySold,
        purchasePrice, priceTotal, datePurchased) VALUES (:stockID, :userID, :quantityBought, 
        :quantitySold, :purchasePrice, :priceTotal, :datePurchased)';

        self::$database->query($sql);
        self::$database->bind(':stockID', $userDAO->getStockID());
        self::$database->bind(':userID', $userDAO->getUserID());
        self::$database->bind(':quantityBought', $userDAO->getQuantityBought());
        self::$database->bind(':quantitySold', $userDAO->getQuantitySold());
        self::$database->bind(':purchasePrice', $userDAO->getPurchasePrice());
        self::$database->bind(':priceTotal', $userDAO->getPriceTotal());
        self::$database->bind(':datePurchased', $userDAO->getDatePurchased());

        self::$database->execute();

    }

    static function getUserStock($stockID, $userID) {
        $sql = 'SELECT * FROM UserStock WHERE stockID = :stockID AND userID = :userID';

        self::$database->query($sql);
        self::$database->bind(':stockID', $stockID);
        self::$database->bind(':userID', $userID);
        self::$database->execute();
    }

    static function updateUserStock(UserStock $userStock) {
        $sql = 'UPDATE UserStock
        SET quantityBought = :quantityBought,
        SET quantitySold = :quantitySold,
        SET purchasePrice = :purchasePrice,
        SET priceTotal = :priceTotal,
        SET datePurchased = :datePurchased
        WHERE stockID = :stockID AND userID = :userID';

        self::$database->query($sql);
        self::$database->bind(':quantityBought', $userStock->getQuantityBought());
        self::$database->bind(':quantitySold', $user->getQuantitySold());
        self::$database->bind(':purchasePrice', $user->getPurchasePrice());
        self::$database->bind(':priceTotal', $user->getPriceTotal());
        self::$database->bind(':datePurchased', $user->getDatePurchase());
        self::$database->bind(':stockID', $user->getStockID());
        self::$database->bind(':userID', $user->getUserID());
        self::$database->execute();

    }

    static function deleteUserStock($stockID, $userID) {
        $sql = 'DELETE FROM UserStock WHERE stockID = :stockID AND userID = :userID';

        self::$database->query($sql);
        self::$database->bind(':stockID', $stockID);
        self::$database->bind(':userID', $userID);
        self::$database->execute();
        
    }
}

?>