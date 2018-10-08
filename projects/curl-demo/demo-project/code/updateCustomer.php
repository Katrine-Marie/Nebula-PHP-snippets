<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if($_POST['submit']){
	require('../class/Curl.php');
	require('../class/Customer.php');
	
	$id = $_SESSION['id'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$zipcode = $_POST['zipcode'];
	
	$customer = new Customer($id, $username, $password, $name, $email, $address, $zipcode);
	
	$newCustomer = json_encode($customer);
	
	var_dump($newCustomer);
	
	$curl = new Curl();
	$curl->put("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/customer", $newCustomer);
	
	header("Location: ../index.php?page=home&customer_updated=true");
	
}else {
	header("Location: ../index.php");
}
