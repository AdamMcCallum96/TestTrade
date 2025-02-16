<?php
Class StockOrders {
private $ID;
private $stockID;
private $userID;
private $currencyCode;
private $totalQProposed;
private $totalQFilled;
private $orderStatus;
private $tradeAction;
private $tradeType;
private $tradePeriod;
private $placedTime;
public function getID(){return $this->ID;}
public function getStockID(){return $this->stockID;}
public function getUserID(){return $this->userID;}
public function getCurrencyCode(){return $this->currencyCode;}
public function getTotalQProposed(){return $this->totalQProposed;}
public function getTotalQFilled(){return $this->totalQFilled;}
public function getOrderStatus(){return $this->orderStatus;}
public function getTradeAction(){return $this->tradeAction;}
public function getTradeType(){return $this->tradeType;}
public function getTradePeriod(){return $this->tradePeriod;}
public function getPlacedTime(){return $this->placedTime;}
public function setID($ID){$this->ID= $ID;}
public function setStockID($stockID){$this->stockID= $stockID;}
public function setUserID($userID){$this->userID= $userID;}
public function setCurrencyCode($currencyCode){$this->currencyCode= $currencyCode;}
public function setTotalQProposed($totalQProposed){$this->totalQProposed= $totalQProposed;}
public function setTotalQFilled($totalQFilled){$this->totalQFilled= $totalQFilled;}
public function setOrderStatus($orderStatus){$this->orderStatus= $orderStatus;}
public function setTradeAction($tradeAction){$this->tradeAction= $tradeAction;}
public function setTradeType($tradeType){$this->tradeType= $tradeType;}
public function setTradePeriod($tradePeriod){$this->tradePeriod= $tradePeriod;}
public function setPlacedTime($placedTime){$this->placedTime= $placedTime;}
}
?>