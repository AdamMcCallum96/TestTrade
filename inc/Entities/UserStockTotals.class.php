<?php
Class UserStockTotals {
private $stockID;
private $userID;
private $boughtPriceAvg;
private $soldPriceAvg;
private $boughtPriceTotal;
private $soldPriceTotal;
public function getStockID(){return $this->stockID;}
public function getUserID(){return $this->userID;}
public function getBoughtPriceAvg(){return $this->boughtPriceAvg;}
public function getSoldPriceAvg(){return $this->soldPriceAvg;}
public function getBoughtPriceTotal(){return $this->boughtPriceTotal;}
public function getSoldPriceTotal(){return $this->soldPriceTotal;}
public function setStockID($stockID){$this->stockID= $stockID;}
public function setUserID($userID){$this->userID= $userID;}
public function setBoughtPriceAvg($boughtPriceAvg){$this->boughtPriceAvg= $boughtPriceAvg;}
public function setSoldPriceAvg($soldPriceAvg){$this->soldPriceAvg= $soldPriceAvg;}
public function setBoughtPriceTotal($boughtPriceTotal){$this->boughtPriceTotal= $boughtPriceTotal;}
public function setSoldPriceTotal($soldPriceTotal){$this->soldPriceTotal= $soldPriceTotal;}
}
?>