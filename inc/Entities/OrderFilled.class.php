<?php
Class OrderFilled {
    private $fillID;
    private $stockOrderID;
    private $quantityFilled;
    private $sharePrice;
    private $totalPrice;
    private $fillTime;
    public function getFillID(){return $this->fillID;}
    public function getStockOrderID(){return $this->stockOrderID;}
    public function getQuantityFilled(){return $this->quantityFilled;}
    public function getSharePrice(){return $this->sharePrice;}
    public function getTotalPrice(){return $this->totalPrice;}
    public function getFillTime(){return $this->fillTime;}
    public function setFillID($fillID){$this->fillID= $fillID;}
    public function setStockOrderID($stockOrderID){$this->stockOrderID= $stockOrderID;}
    public function setQuantityFilled($quantityFilled){$this->quantityFilled= $quantityFilled;}
    public function setSharePrice($sharePrice){$this->sharePrice= $sharePrice;}
    public function setTotalPrice($totalPrice){$this->totalPrice= $totalPrice;}
    public function setFillTime($fillTime){$this->fillTime= $fillTime;}
    }
?>