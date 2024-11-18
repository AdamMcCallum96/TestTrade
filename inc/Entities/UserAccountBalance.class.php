<?php
Class UserAccountBalance {
private $user_id;
private $currencyCode;
private $balance;
public function getUser_id(){return $this->user_id;}
public function getCurrencyCode(){return $this->currencyCode;}
public function getBalance(){return $this->balance;}
public function setUser_id($user_id){$this->user_id= $user_id;}
public function setCurrencyCode($currencyCode){$this->currencyCode= $currencyCode;}
public function setBalance($balance){$this->balance= $balance;}
}
?>