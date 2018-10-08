<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if($_POST['submit']){
	require('../class/Curl.php');
	require('../class/Order.php');
	require('../class/Status.php');
	
	$id = $_POST['orderId'];
	$customerId = $_POST['customerId'];
	$timestamp = $_POST['timestamp'];
	
	$status = new Status(2, null);
	$order = new Order($id, $customerId, $timestamp, $status);
	
	$newOrder = json_encode($order);
	
	var_dump($newOrder);
	
	$curl = new Curl();
	$curl->put("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/order", $newOrder);
	
	header("Location: ../index.php?page=customers&order_updated=true");
	
}else {
	header("Location: ../index.php?page=customers");
}
