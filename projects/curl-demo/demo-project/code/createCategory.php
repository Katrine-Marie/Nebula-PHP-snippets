<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_POST['submit']){
	require('../class/Curl.php');
	require('../class/Category.php');
	
	$name = $_POST['name'];
	
	var_dump($_POST);
	
	$category = new Category(null, $name);
	
	$newCat = json_encode($category);
	
	var_dump($category);
	
	$curl = new Curl();
	$curl->post("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/category", $newCat);
	
	header("Location: ../index.php?category_created=true");
	
}else {
	header("Location: ../index.php");
}
