<?php
Class StockGraphs {
private $user_id;
private $graphID;
private $graphName;
private $graphType;
private $graphCustomTime;
private $graphStartDate;
private $graphEndDate;
public function getUser_id(){return $this->user_id;}
public function getGraphID(){return $this->graphID;}
public function getGraphName(){return $this->graphName;}
public function getGraphType(){return $this->graphType;}
public function getGraphCustomTime(){return $this->graphCustomTime;}
public function getGraphStartDate(){return $this->graphStartDate;}
public function getGraphEndDate(){return $this->graphEndDate;}
public function setUser_id($user_id){$this->user_id= $user_id;}
public function setGraphID($graphID){$this->graphID= $graphID;}
public function setGraphName($graphName){$this->graphName= $graphName;}
public function setGraphType($graphType){$this->graphType= $graphType;}
public function setGraphCustomTime($graphCustomTime){$this->graphCustomTime= $graphCustomTime;}
public function setGraphStartDate($graphStartDate){$this->graphStartDate= $graphStartDate;}
public function setGraphEndDate($graphEndDate){$this->graphEndDate= $graphEndDate;}
}
?>