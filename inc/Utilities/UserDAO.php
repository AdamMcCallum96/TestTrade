<?php

class UserDAO {

    private static $database;

    static function initialize() {
        self::$database = new PDOConnection('User');
    }

    // static function createUser(User $user) {
    //     $sql = "INSERT INTO User (username, email, pass)
    //     VALUES (:username, :email, :pass);";
        
    //     self::$database->query($sql);
    //     self::$database->bind(':username', $user->getUsername());
    //     self::$database->bind(':email', $user->getEmail());
    //     self::$database->bind(':pass', $user->getPass());
    //     self::$database->execute();
    // }

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


    static function getUser($id) {
        $sql = 'SELECT * FROM User WHERE email = :email';
      
        self::$database->query($sql);
        self::$database->bind(':email', $id);
        self::$database->execute();
        return self::$database->singleResult();
    }

    static function getAllUsers($id) {
        $sql = 'SELECT * FROM User';
        
        self::$database->query($sql);
        self::$database->execute();
        return self::$database->resultSet();
    }

    static function getUserPass($email, $password) {
        $sql = 'SELECT * FROM User WHERE email = :email AND pass = :pass';
        
        self::$database->query($sql);
        self::$database->bind(':email', $email);
        self::$database->bind(':pass', $password);
        self::$database->execute();
        return self::$database->singleResult();
    }

    static function updateUser(User $user) {
        $sql = 'UPDATE User
        SET username = :username,
        SET email = :email,
        SET pass = :pass,
        WHERE ID = :id';

        self::$database->query($sql);
        self::$database->bind(':username', $user->getUsername());
        self::$database->bind(':email', $user->getEmail());
        self::$database->bind(':pass', $user->getPass());
        self::$database->bind(':id', $user->getID());
        self::$database->execute();
    }

    static function deleterUser($id) {
        $sql = 'DELETE FROM User WHERE ID = :id';

        self::$database->query($sql);
        self::$database->bind(':id', $id);
        self::$database->execute();


    }

}



?>