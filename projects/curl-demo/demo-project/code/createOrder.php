<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if($_POST['order']){
	require('../class/Curl.php');
	require('../class/Order.php');
	require('../class/Details.php');
	require('../class/Category.php');
	require('../class/Product.php');
	
	$curl = new Curl();
	
	$dt = date("Y-m-d H:i:s");
	
	$order = new Order(NULL, $_SESSION['id'], $dt);
	
	$newOrder = json_encode($order);
	$curl->post("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/order", $newOrder);
	
	$recentOrderResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/newOrder");
	$recentOrder = json_decode($recentOrderResult);
	
	echo '<pre>';
	var_dump($recentOrder);
	echo '</pre>';
	
	foreach($recentOrder as $r){
		echo $orderId = $r->id;
	}
	
	foreach($_SESSION['cart'] as $key=>$cart){
		$details = new Details($cart[2], 1, $orderId, $cart[0], $order);
		
		$productResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/product/{$cart[0]}");
		$product = json_decode($productResult);
		foreach($product as $p){
			$newAmount = $p->amount - 1;
			
			$category = new Category($p->category->categoryId, $p->category->categoryName);
			$newProduct = new Product($p->productName, $p->price, $p->productDescription, $p->productId, $category, $newAmount);
			
			$updated = json_encode($newProduct);
		
			$curl->put("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/product", $updated);
		}
		
// 		echo '<pre>';
// 		echo $details = json_encode($details);
// 		echo '</pre>';
		$details = json_encode($details);
		$curl->post("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/details", $details);
	}
	
	unset($_SESSION['cart']);
	header("Location: ../index.php?page=cart&completed=true");
	
}else {
	header("Location: ../index.php?page=cart");
}
