<?php
class Customer{
		public $id;
    public $name;
    public $username;
    public $password;
    public $email;
    public $address;
		public $zipcode;
    
    function __construct($id=NULL, $username, $password=NULL, $name=NULL, $email=NULL, $address=NULL, $zipcode=NULL) {
				$this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
				$this->zipcode = $zipcode;
    }
}