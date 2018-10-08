<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_POST['submit']){
	require('../class/Curl.php');
	require('../class/Customer.php');
	
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$zipcode = $_POST['zipcode'];
	
	$customer = new Customer(NULL, $username, $password, $name, $email, $address, $zipcode);
	
	$newCustomer = json_encode($customer);
	
	$curl = new Curl();
	$curl->post("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/customer", $newCustomer);
	
// 	echo '<pre>';
// 	var_dump($newProduct);
// 	echo '</pre>';
	
	header("Location: ../index.php?customer_created=true");
	
}else {
	header("Location: ../index.php");
}
