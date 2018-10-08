<?php
	$curl = new Curl();
	
	$productResult = $curl->get('http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/product');
	$product = json_decode($productResult);

	$categoryResult = $curl->get('http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/category');
	$category = json_decode($categoryResult);

	$cpResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/category/{$_GET['id']}");
	$productByCategory = json_decode($cpResult);

	$productIdResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/product/{$_GET['id']}");
	$currentProduct = json_decode($productIdResult);

	$orderResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/order");
	$allOrders = json_decode($orderResult);

	$customerResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/customer");
	$allCustomers = json_decode($customerResult);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Webshop</title>
	
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="<?php echo $_GET['page']; ?>">
	<?php require_once('includes/menu.php'); ?>