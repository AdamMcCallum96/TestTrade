<?php
Class StockGraphsTickers {
private $user_id;
private $graph_id;
private $stock_id;
public function getUser_id(){return $this->user_id;}
public function getGraph_id(){return $this->graph_id;}
public function getStock_id(){return $this->stock_id;}
public function setUser_id($user_id){$this->user_id= $user_id;}
public function setGraph_id($graph_id){$this->graph_id= $graph_id;}
public function setStock_id($stock_id){$this->stock_id= $stock_id;}
}
?>