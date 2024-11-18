<?php

Class PDOConnection {

    
    private $_dbName = DB_NAME;
    private $_dbHost = DB_HOST;
    private $_dbUser = DB_USER;
    private $_dbPass = DB_PASS;

    private $_dbh;
    private $_className;
    private $_pstmt;

    public function __construct($className) {
        
        // var_dump("PDO SERVICE CALL");
        $this->_className = $className;
        $dataSourceName = 'mysql:dbname='.$this->_dbName.';host='.$this->_dbHost;
       
        
        $PDOSettings = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        
        try {
            
            $this->_dbh = new PDO($dataSourceName, $this->_dbUser, $this->_dbPass, $PDOSettings);
        }   catch (PDOException $er)    {
            $this->_error = $er->getMessage();
            echo $er->getMessage();
        }
       
    }

    public function bind($param, $value, $type=null)    {

        if (is_null($type)) {

            switch (true)   {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
                default:
                    $type = PDO::PARAM_STR;
                break;
            }
        }

        //Bind the parameter to the prepared statement
        $this->_pstmt->bindValue($param, $value, $type);

    }
    public function execute()   {
        return $this->_pstmt->execute();
    }

    //Return more than one result
    public function resultSet() {
        return $this->_pstmt->fetchAll(PDO::FETCH_CLASS, $this->_className);
    }

    //Returns an array from the database
    public function resultSetCustom() {
        return $this->_pstmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Returns a single result from the database
    public function singleResult() {
        $this->_pstmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        return $this->_pstmt->fetch(PDO::FETCH_CLASS);
    }
  
    public function rowCount(): int {
        return $this->_pstmt->rowCount();
    }

    public function query($sql) {
       
        $this->_pstmt = $this->_dbh->prepare($sql);
    }

    public function lastInsertedId() {
        return $this->_dbh->lastInsertId();
    }
}


?>