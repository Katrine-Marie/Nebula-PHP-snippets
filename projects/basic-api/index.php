<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'class/DbCon.php';

$dbCon = new DbCon();

$httpMethod = $_SERVER['REQUEST_METHOD'];

$uri = explode("/", $_SERVER['REQUEST_URI']);
//var_dump($uri);

// GET ROUTES
if($httpMethod == 'GET'){
	if(isset($uri[5]) && $uri[4] == 'zip'){
        // Valider med regular expression om postnummeret er gyldigt
        if(preg_match('/^(\d{3,4})?$/', $uri[5])){
            header('Content-type: application/json');
            $city = $dbCon->getCityByZipCode($uri[5]);
            echo json_encode($city);
        } else {
            echo 'ERROR WRONG ZIPCODE FORMAT!';
        }
    }
		else if(isset($uri[5]) && isset($uri[6]) && $uri[4] == 'customer'){
        header('Content-type: application/json');
        $customer = $dbCon->getCustomer($uri[5], $uri[6]);
        echo json_encode($customer);
    }
		else if (isset($uri[6]) &&  $uri[5] == 'single' && $uri[4] == 'category'){
      header('Content-type: application/json');
      $order = $dbCon->getCategoryById($uri[6]);
      echo json_encode($order);
    }
		else if(isset($uri[5]) && $uri[5] == 'customer' && isset($uri[6]) && $uri[4] == 'order'){
        header('Content-type: application/json');
        $order = $dbCon->getOrder($uri[6]);
        echo json_encode($order);
    }
    // Søg på produkter /product/search/xxxx
    else if ((isset($uri[4]) && isset($uri[5]) && isset($uri[6])) && ($uri[4] == 'product' && $uri[5] == 'search')){
        if($uri[6] != ''){
            header('Content-type: application/json');
            $product = $dbCon->getProductBySearch($uri[6]);
            echo json_encode($product);
        } else {
            echo 'No search string given!';
        }
    }
	else if(isset($uri[5]) && $uri[4] == 'category'){
						header('Content-type: application/json');
            $products = $dbCon->getProductsByCategory($uri[5]);
            echo json_encode($products);
	}
    // Produkter med id /product/xx
    else if (isset($uri[5]) && $uri[4] == 'product'){
        if(preg_match('/^(\d)+?$/', $uri[5])){
            header('Content-type: application/json');
            $product = $dbCon->getProductById($uri[5]);
            echo json_encode($product);
        }
    }
	 	else if (isset($uri[5]) && $uri[4] == 'order'){
      header('Content-type: application/json');
      $order = $dbCon->getOrderByCustomer($uri[5]);
      echo json_encode($order);
    }
		else if (isset($uri[5]) && $uri[4] == 'details'){
      header('Content-type: application/json');
      $order = $dbCon->getOrderDetails($uri[5]);
      echo json_encode($order);
    }
	else if (isset($uri[5]) && $uri[4] == 'customer'){
      header('Content-type: application/json');
      $customer = $dbCon->getCustomerById($uri[5]);
      echo json_encode($customer);
    }
    // Alle produkter /product
    else if($uri[4] == 'product'){
        header('Content-type: application/json');
        $products = $dbCon->getAllProducts();
        echo json_encode($products);
    }
		// Alle kunder
    else if($uri[4] == 'customer'){
        header('Content-type: application/json');
        $customer = $dbCon->getAllCustomers();
        echo json_encode($customer);
    }
	// Alle kategorier
    else if($uri[4] == 'category'){
				header('Content-type: application/json');
        $cats = $dbCon->getAllCategories();
        echo json_encode($cats);
    }
	// Alle ordrer
    else if($uri[4] == 'order'){
				header('Content-type: application/json');
        $orders = $dbCon->getAllOrders();
        echo json_encode($orders);
    }
	// Nyeste ordre
    else if($uri[4] == 'newOrder'){
				header('Content-type: application/json');
        $orders = $dbCon->getNewestOrder();
        echo json_encode($orders);
    }
	// Alle admins
    else if($uri[4] == 'admin'){
				header('Content-type: application/json');
        $admins = $dbCon->getAllAdmins();
        echo json_encode($admins);
    }
	else if($uri[4] == 'zip'){
				header('Content-type: application/json');
        $zip = $dbCon->getAllCities();
        echo json_encode($zip);
    }
    else {
        echo 'WRONG PATH';
    }
}
// POST ROUTES
else if ($httpMethod == 'POST'){
    // Product
    if ($uri[4] == 'product'){
    	var_dump($dbCon->postProduct(file_get_contents('php://input')));
    }
		else if ($uri[4] == 'order'){
    	var_dump($dbCon->postOrder(file_get_contents('php://input')));
    }
		else if ($uri[4] == 'details'){
    	var_dump($dbCon->postDetails(file_get_contents('php://input')));
    }

		else if ($uri[4] == 'category'){
    	var_dump($dbCon->postCategory(file_get_contents('php://input')));
    }
		else if ($uri[4] == 'customer'){
    	var_dump($dbCon->postCustomer(file_get_contents('php://input')));
    }
}
// PUT ROUTES
else if ($httpMethod == 'PUT'){
    // Product
    if ($uri[4] == 'product'){
    	var_dump($dbCon->updateProduct(file_get_contents('php://input')));
    }
	// Order
    else if ($uri[4] == 'order'){
    	var_dump($dbCon->updateOrder(file_get_contents('php://input')));
    }
	// Customer
    else if ($uri[4] == 'customer'){
    	var_dump($dbCon->updateCustomer(file_get_contents('php://input')));
    }
}
// DELETE ROUTES
else if ($httpMethod == 'DELETE'){
    // Product
    if ($uri[4] == 'product' && isset($uri[5])){
			if($dbCon->deleteProduct($uri[5])){
				echo 'Product was deleted';
			}else {
				echo 'Error';
			}


    }
}
