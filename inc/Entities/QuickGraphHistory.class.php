<?php

Class QuickGraphHistory {
    private $history_id;
    private $user_id;
    private $historyText;
    public function getHistory_id(){return $this->history_id;}
    public function getUser_id(){return $this->user_id;}
    public function getHistoryText(){return $this->historyText;}
    public function setHistory_id($history_id){$this->history_id= $history_id;}
    public function setUser_id($user_id){$this->user_id= $user_id;}
    public function setHistoryText($historyText){$this->historyText= $historyText;}
    }
?>