<?php

class StockDaily implements JsonSerializable{

    private $stockID;
    private $stockDate;
    private $stockValue;

    public function getStockID(){return $this->stockID;}
    public function getStockDate(){return $this->stockDate;}
    public function getStockValue(){return $this->stockValue;}
    public function setStockID($stockID){$this->stockID= $stockID;}
    public function setStockDate($stockDate){$this->stockDate= $stockDate;}
    public function setStockValue($stockValue){$this->stockValue= $stockValue;}
    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
}




?>