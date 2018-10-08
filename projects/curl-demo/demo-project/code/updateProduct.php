<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_POST['submit']){
	require('../class/Curl.php');
	require('../class/Product.php');
	require('../class/Category.php');
	
	$productId = $_POST['id'];
	$productName = $_POST['productName'];
	$price = $_POST['price'];
	$productDescription = $_POST['productDescription'];
	$categoryId = $_POST['category'];
	$amount = $_POST['amount'];
	
	$category = new Category($categoryId);
	$product = new Product($productName, $price, $productDescription, $productId, $category, $amount);
	
	$newProduct = json_encode($product);
	
	$curl = new Curl();
	$curl->put("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/product", $newProduct);
	
// 	echo '<pre>';
// 	var_dump($newProduct);
// 	echo '</pre>';
	
	header("Location: ../index.php?page=product_overview&product_updated=true");
	
}else {
	header("Location: ../index.php");
}
