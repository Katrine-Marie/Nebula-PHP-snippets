<?php
session_start();

require_once('../class/Curl.php');

	if(isset($_POST['submit'])){
		$curl = new Curl();
		$adminResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/admin/{$_POST['username']}/{$_POST['password']}");

		$admin = json_decode($adminResult);

// 		var_dump($customer);
		
		if(!empty($admin)){
			// OVERFØR VÆRDIER TIL SESSION-VARIABLER
			foreach($admin as $a){
				$_SESSION['admin_id'] = $a->id;
				$_SESSION['name'] = $a->name;
				$_SESSION['username'] = $a->username;
			}
			
			header("Location: ../index.php");
		}else {
			header("Location: ../index.php?page=login&err2=true");
		}
	}