<?php
Class User {
private $email;
private $username;
private $pass;
private $firstName;
private $lastName;
private $dateOfBirth;
public function getEmail(){return $this->email;}
public function getUsername(){return $this->username;}
public function getPass(){return $this->pass;}
public function getFirstName(){return $this->firstName;}
public function getLastName(){return $this->lastName;}
public function getDateOfBirth(){return $this->dateOfBirth;}
public function setEmail($email){$this->email= $email;}
public function setUsername($username){$this->username= $username;}
public function setPass($pass){$this->pass= $pass;}
public function setFirstName($firstName){$this->firstName= $firstName;}
public function setLastName($lastName){$this->lastName= $lastName;}
public function setDateOfBirth($dateOfBirth){$this->dateOfBirth= $dateOfBirth;}
}
?>