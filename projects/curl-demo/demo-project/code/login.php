<?php
session_start();

require_once('../class/Curl.php');

	if(isset($_POST['submit'])){
		$curl = new Curl();
		$customerResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/customer/{$_POST['username']}/{$_POST['password']}");

		$customer = json_decode($customerResult);

// 		var_dump($customer);
		
		if(!empty($customer)){
			// OVERFØR VÆRDIER TIL SESSION-VARIABLER
			foreach($customer as $c){
				$_SESSION['id'] = $c->id;
				$_SESSION['name'] = $c->name;
				$_SESSION['username'] = $c->username;
				$_SESSION['address'] = $c->address;
				$_SESSION['zipcode'] = $c->zipcode;
			}
			
			header("Location: ../index.php");
		}else {
			header("Location: ../index.php?page=login&err=true");
		}
	}