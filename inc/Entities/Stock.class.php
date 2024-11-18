<?php

Class Stock {
    private $ID;
    private $stockName;
    private $stockRegion;
    private $stockMarketOpen;
    private $stockMarketClose;
    private $stockTimezone;
    private $stockCurrency;

    public function getID(){return $this->ID;}
    public function getStockName(){return $this->stockName;}
    public function getStockRegion(){return $this->stockRegion;}
    public function getStockMarketOpen(){return $this->stockMarketOpen;}
    public function getStockMarketClose(){return $this->stockMarketClose;}
    public function getStockTimezone(){return $this->stockTimezone;}
    public function getStockCurrency(){return $this->stockCurrency;}
    public function setID($ID){$this->ID= $ID;}
    public function setStockName($stockName){$this->stockName= $stockName;}
    public function setStockRegion($stockRegion){$this->stockRegion= $stockRegion;}
    public function setStockMarketOpen($stockMarketOpen){$this->stockMarketOpen= $stockMarketOpen;}
    public function setStockMarketClose($stockMarketClose){$this->stockMarketClose= $stockMarketClose;}
    public function setStockTimezone($stockTimezone){$this->stockTimezone= $stockTimezone;}
    public function setStockCurrency($stockCurrency){$this->stockCurrency= $stockCurrency;}

}




?>