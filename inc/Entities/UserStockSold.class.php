<?php
Class UserStockSold {
private $stockSoldID;
private $stockID;
private $userID;
private $price;
private $quantity;
private $timeSold;
private $finalized;
public function getStockSoldID(){return $this->stockSoldID;}
public function getStockID(){return $this->stockID;}
public function getUserID(){return $this->userID;}
public function getPrice(){return $this->price;}
public function getQuantity(){return $this->quantity;}
public function getTimeSold(){return $this->timeSold;}
public function getFinalized(){return $this->finalized;}
public function setStockSoldID($stockSoldID){$this->stockSoldID= $stockSoldID;}
public function setStockID($stockID){$this->stockID= $stockID;}
public function setUserID($userID){$this->userID= $userID;}
public function setPrice($price){$this->price= $price;}
public function setQuantity($quantity){$this->quantity= $quantity;}
public function setTimeSold($timeSold){$this->timeSold= $timeSold;}
public function setFinalized($finalized){$this->finalized= $finalized;}
}
?>