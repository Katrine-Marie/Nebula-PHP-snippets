<?php
class Admin{
		public $id;
    public $name;
    public $username;
    public $password;
    public $email;
    
    function __construct($id=NULL, $username, $password=NULL, $name=NULL, $email=NULL) {
				$this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->email = $email;
    }
}