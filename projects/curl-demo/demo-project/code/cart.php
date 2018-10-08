<?php
	require_once('class/Curl.php');

  function addToCart($productId){
    
    // Select information from the selected product
    $curl = new Curl();
		
		$pResult = $curl->get("http://katb14.wi2.sde.dk/15OWI32b/dynamisk-web/webshop-ws/product/{$_POST['productId']}");

		$p = json_decode($pResult);
    
    $cart = $_SESSION['cart'];
    
    foreach($p as $product){
			
			$productId = $product->productId;
			$productName = $product->productName;
			$price = $product->price;
			$category = $product->category->categoryName;			
      
      $cart[] = array($productId, $productName, $price, $category);
    }
    
    $_SESSION['cart'] = $cart;
    
    // Go back to page the product was added from
    header("Location: index.php?page=product&id={$_POST['productId']}&added=true");
  }

  // Get the amount of products in cart
  function getCartProductAmount(){
    if(isset($_SESSION['cart'])){
      return count($_SESSION['cart']);
    }
    else{
      return '0';
    }
  }

  function unsetCartSession(){
    unset($_SESSION['cart']);
    
    header("Location: index.php?page=cart");
  }

?>