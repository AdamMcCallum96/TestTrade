<?php
Class UserStockBought {
private $stockBoughtID;
private $stockID;
private $userID;
private $price;
private $quantity;
private $timeBought;
private $finalized;
public function getStockBoughtID(){return $this->stockBoughtID;}
public function getStockID(){return $this->stockID;}
public function getUserID(){return $this->userID;}
public function getPrice(){return $this->price;}
public function getQuantity(){return $this->quantity;}
public function getTimeBought(){return $this->timePurchased;}
public function getFinalized(){return $this->finalized;}
public function setStockBoughtID($stockBoughtID){$this->stockBoughtID= $stockBoughtID;}
public function setStockID($stockID){$this->stockID= $stockID;}
public function setUserID($userID){$this->userID= $userID;}
public function setPrice($price){$this->price= $price;}
public function setQuantity($quantity){$this->quantity= $quantity;}
public function setTimeBought($timePurchased){$this->timePurchased= $timePurchased;}
public function setFinalized($finalized){$this->finalized= $finalized;}
}
?>