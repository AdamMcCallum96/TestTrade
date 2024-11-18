<?php
Class Currency {
private $currencyCode;
private $currencyName;
public function getCurrencyCode(){return $this->currencyCode;}
public function getCurrencyName(){return $this->currencyName;}
public function setCurrencyCode($currencyCode){$this->currencyCode= $currencyCode;}
public function setCurrencyName($currencyName){$this->currencyName= $currencyName;}
}
?>