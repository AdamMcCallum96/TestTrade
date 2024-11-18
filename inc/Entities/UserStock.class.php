<?php
Class UserStock {
    
    private $stockID;
    private $userID;
    private $quantityBought;
    private $quantitySold;
    private $purchasePrice;
    private $priceTotal;
    private $datePurchased;
    
    public function getStockID(){return $this->stockID;}
    public function getUserID(){return $this->userID;}
    public function getQuantityBought(){return $this->quantityBought;}
    public function getQuantitySold(){return $this->quantitySold;}
    public function getPurchasePrice(){return $this->purchasePrice;}
    public function getPriceTotal(){return $this->priceTotal;}
    public function getDatePurchased(){return $this->datePurchased;}
    public function setStockID($stockID){$this->stockID= $stockID;}
    public function setUserID($userID){$this->userID= $userID;}
    public function setQuantityBought($quantityBought){$this->quantityBought= $quantityBought;}
    public function setQuantitySold($quantitySold){$this->quantitySold= $quantitySold;}
    public function setPurchasePrice($purchasePrice){$this->purchasePrice= $purchasePrice;}
    public function setPriceTotal($priceTotal){$this->priceTotal= $priceTotal;}
    public function setDatePurchased($datePurchased){$this->datePurchased= $datePurchased;}
}


?>