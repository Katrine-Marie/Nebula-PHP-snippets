<?php
require_once 'Config.php';
include 'Category.php';
include 'City.php';
include 'Product.php';
include 'Customer.php';
include 'Order.php';
include 'Status.php';
include 'Details.php';
include 'Admin.php';

class DbCon{
    
    private $ObjConnection;
    
    // Constructor method, bliver altid eksekveret når der instatnieres et objekt af klassen
    function __construct() {
        if(Config::useLocal){
            $this->ObjConnection = new mysqli(Config::localHost, Config::localUser, Config::localPassword, Config::localDatabase);
        } else {
            $this->ObjConnection = new mysqli(Config::host, Config::user, Config::password, Config::database);
        }
        
        if($this->testDbConnection()){
            $this->ObjConnection->set_charset('utf8');
            return $this->ObjConnection;
        }
    }
    
    // Test om der er forbindelse ellers dø
    private function testDbConnection(){
        
        if($this->ObjConnection->connect_error){
            die('Der er en fejl i databaseforbindelsen '.$this->ObjConnection->connect_errno. ' '.$this->ObjConnection->connect_error);
        } else {
            return TRUE;
        }
    }
    
    public function query($sql){
        return $this->ObjConnection->query($sql);
    }
  
    public function getCityByZipCode($zipCode){
        $sql = 'SELECT * FROM zipcity WHERE zipcode = ' . $zipCode . '';
        $result = $this->query($sql);
        
        while($row = $result->fetch_object()){
            return new City($row->zipcode, $row->cityname);
        }
    }
  
    public function getAllCities(){
        $sql = 'SELECT * FROM zipcity';
        $result = $this->query($sql);
        
        $cities = array();
      
        while($row = $result->fetch_object()){
            $cities[] = new City($row->zipcode, $row->cityname);
        }
      
      return $cities;
    }
  
    public function getAllCategories(){
        $sql = 'SELECT ws_category.id, ws_category.categoryname FROM ws_category';
        $result = $this->query($sql);
        
        $cats = array();
        
        while($row = $result->fetch_object()){
            $cats[] = new Category($row->id, $row->categoryname);
        }
        
        return $cats;
    }
  
    public function getCategoryById($id){
        $sql = "SELECT ws_category.id, ws_category.categoryname FROM ws_category WHERE id = {$id}";
        $result = $this->query($sql);
        
        $cats = array();
        
        while($row = $result->fetch_object()){
            $cats[] = new Category($row->id, $row->categoryname);
        }
        
        return $cats;
    }
    
    public function getAllProducts(){
        $sql = 'SELECT ws_product.id, ws_product.productname, ws_product.price, ws_product.productdescription, ws_product.product_amount, ws_category.id AS categoryid, ws_category.categoryname FROM ws_product INNER JOIN ws_category ON ws_product.category_id = ws_category.id';
        $result = $this->query($sql);
        
        $products = array();
        
        while($row = $result->fetch_object()){
            $category = new Category($row->categoryid, $row->categoryname);
            $products[] = new Product($row->productname, $row->price, $row->productdescription, $row->id, $category, $row->product_amount);
        }
        
        return $products;
    }
    
    public function getProductById($productId){
        $sql = 'SELECT ws_product.id, ws_product.productname, ws_product.price, ws_product.productdescription, product_amount, ws_category.id AS categoryid, ws_category.categoryname FROM ws_product INNER JOIN ws_category ON ws_product.category_id = ws_category.id WHERE ws_product.id = '.$productId;
        $result = $this->query($sql);
        
        $products = array();
      
        while($row = $result->fetch_object()){
            $category = new Category($row->categoryid, $row->categoryname);
            $products[] = new Product($row->productname, $row->price, $row->productdescription, $row->id, $category, $row->product_amount);
        }
        return $products;
    }
  
    public function getProductsByCategory($catId){
        $sql = 'SELECT ws_product.id, ws_product.productname, ws_product.price, ws_product.productdescription, product_amount, ws_category.id AS categoryid, ws_category.categoryname FROM ws_product INNER JOIN ws_category ON ws_product.category_id = ws_category.id WHERE ws_category.id = '.$catId;
        $result = $this->query($sql);
        
        $products = array();
        
        while($row = $result->fetch_object()){
            $category = new Category($row->categoryid, $row->categoryname);
            $products[] = new Product($row->productname, $row->price, $row->productdescription, $row->id, $category, $row->product_amount);
        }
        
        return $products;
        
    }
    
    public function getProductBySearch($search){
        $searchString = $this->ObjConnection->real_escape_string($search);
        $sql = "SELECT id, productname, price, productdescription, product_amount FROM ws_product WHERE productname LIKE '%$searchString%' OR productdescription LIKE '%$searchString%'";
        
        $result = $this->query($sql);
        
        $products = array();
        
        while($row = $result->fetch_object()){
            $products[] = new Product($row->productname, $row->price, $row->productdescription, $row->id, null, $row->product_amount);
        }
        
        return $products;
    }
  
  public function getCustomer($username, $password){
        $sql = "SELECT * FROM ws_customer WHERE username = '{$username}' AND password = '{$password}'";
        $result = $this->query($sql);
        
        $customer = array();
      
        while($row = $result->fetch_object()){
            $customer[] = new Customer($row->id, $row->username, $row->password, $row->name, $row->email, $row->address, $row->zipcode);
        }
        return $customer;
    }
  public function getCustomerById($id){
        $sql = "SELECT * FROM ws_customer WHERE id = {$id}";
        $result = $this->query($sql);
        
        $customer = array();
      
        while($row = $result->fetch_object()){
            $customer[] = new Customer($row->id, $row->username, $row->password, $row->name, $row->email, $row->address, $row->zipcode);
        }
        return $customer;
    }
  public function getAllCustomers(){
        $sql = "SELECT * FROM ws_customer";
        $result = $this->query($sql);
        
        $customer = array();
      
        while($row = $result->fetch_object()){
            $customers[] = new Customer($row->id, $row->username, $row->password, $row->name, $row->email, $row->address, $row->zipcode);
        }
        return $customers;
    }
  
  public function getAllAdmins(){
        $sql = "SELECT * FROM ws_admins";
        $result = $this->query($sql);
        
        $admins = array();
      
        while($row = $result->fetch_object()){
            $admins[] = new Admin($row->id, $row->username, $row->password, $row->name, $row->email);
        }
        return $admins;
    }
  
  public function getAllOrders(){
    $sql = "SELECT *, ws_details.id AS d_id, ws_order.id AS o_id, ws_status.id AS s_id FROM ws_order INNER JOIN ws_details ON (ws_details.order_id = ws_order.id) INNER JOIN ws_status ON (ws_status.id = ws_order.status_id)";
    $result = $this->query($sql);
    
    $order = array();
      
    while($row = $result->fetch_object()){
      $status = new Status($row->s_id, $row->status);
      $o = new Order($row->o_id, $row->customer_id, $row->dt, $status);
      $order[] = new Details($row->price, $row->amount, $row->order_id, $row->product_id, $o);
    }
    return $order;
  }
  
  public function getOrder($customer_id){
    $sql = "SELECT *, ws_details.id AS d_id, ws_order.id AS o_id, ws_status.id AS s_id FROM ws_order INNER JOIN ws_details ON (ws_details.order_id = ws_order.id) INNER JOIN ws_status ON (ws_status.id = ws_order.status_id) WHERE customer_id = {$customer_id}";
    $result = $this->query($sql);
    
    $order = array();
      
    while($row = $result->fetch_object()){
      $status = new Status($row->s_id, $row->status);
      $order[] = new Order($row->id, $row->customer_id, $row->dt, $status);
    }
    return $order;
  }
  
  public function getOrderDetails($order_id){
    $sql = "
      SELECT *, ws_details.id AS d_id, ws_order.id AS o_id, ws_status.id AS s_id 
      FROM ws_order 
      INNER JOIN ws_details 
      ON (ws_details.order_id = ws_order.id)
      INNER JOIN ws_customer
      ON (ws_customer.id = ws_order.customer_id)
      INNER JOIN ws_status
      ON (ws_status.id = ws_order.status_id)
      WHERE order_id = '{$order_id}'
    ";
    $result = $this->query($sql);
    
    $order = array();
      
    while($row = $result->fetch_object()){
      $status = new Status($row->s_id, $row->status);
      $o = new Order($row->o_id, $row->customer_id, $row->dt, $status);
      $order[] = new Details($row->price, $row->amount, $row->order_id, $row->product_id, $o);
    }
    return $order;
  }
  
  public function getNewestOrder(){
    $sql = "SELECT * FROM ws_order ORDER BY id DESC LIMIT 1";
    $result = $this->query($sql);
    
    $order = array();
      
    while($row = $result->fetch_object()){
      $order[] = new Order($row->id, $row->customer_id, $row->dt);
//       $order[] = new Details($row->price, $row->amount, $row->order_id, $row->product_id, $o);
    }
    return $order;
  }
  
  public function getOrderByCustomer($customer_id){
    $sql = "
      SELECT *, ws_details.id AS d_id, ws_order.id AS o_id, ws_status.id AS s_id 
      FROM ws_order 
      INNER JOIN ws_details 
      ON (ws_details.order_id = ws_order.id)
      INNER JOIN ws_customer
      ON (ws_customer.id = ws_order.customer_id)
      INNER JOIN ws_status
      ON (ws_status.id = ws_order.status_id)
      WHERE customer_id = '{$customer_id}'
    ";
    $result = $this->query($sql);
    
    $order = array();
      
    while($row = $result->fetch_object()){
      $status = new Status($row->s_id, $row->status);
      $o = new Order($row->o_id, $row->customer_id, $row->dt, $status);
      $order[] = new Details($row->price, $row->amount, $row->order_id, $row->product_id, $o);
    }
    return $order;
  }
  
  
    public function postOrder($input){
        // Create output using input
        $values = (object)array(
            'input' => json_decode($input)
        );
        
        $dt = $values->input->timestamp;
        $customerId = $values->input->customerId;      
      
        $order = new Order(NULL, $customerId, $dt);
        
        $sql = "INSERT INTO ws_order (id, dt, customer_id, status_id) 
        VALUES ('','{$order->timestamp}',{$order->customerId}, 1)";
                
        $this->query($sql);
    }
  
    public function postDetails($input){
        // Create output using input
        $values = (object)array(
            'input' => json_decode($input)
        );
      
        $price = $values->input->price;
        $amount = $values->input->amount;
        $orderId = $values->input->orderId;
        $productId = $values->input->productId;
        $customerId = $values->input->order->customerId;
      
        $order = new Order($orderId, $customerId);
        $details = new Details($price, $amount, $orderId, $productId, $order);
        
        $sql = "INSERT INTO ws_details (id, price, amount, order_id, product_id) VALUES ('', " 
                . "{$details->price}, "
                . "'{$details->amount}', "
                . "'{$details->orderId}', "
                . "'{$details->productId}'"
                . ")";
                
        $this->query($sql);
    }
  
    public function postCategory($input){
        // Create output using input
        $values = (object)array(
            'input' => json_decode($input)
        );
        
        $name = $this->ObjConnection->real_escape_string($values->input->categoryName);
      
        $category = new Category(NULL, $name);
        
        $sql = "INSERT INTO ws_category (id, categoryname) VALUES ('', '{$category->categoryName}')";
                
        if($this->query($sql)){
          return true;
        } else {
            return false;
        }
    }
  
    public function postCustomer($input){
        // Create output using input
        $values = (object)array(
            'input' => json_decode($input)
        );
        
        $username = $this->ObjConnection->real_escape_string($values->input->username);
        $password = $this->ObjConnection->real_escape_string($values->input->password);
        $name = $this->ObjConnection->real_escape_string($values->input->name);   
        $email = $this->ObjConnection->real_escape_string($values->input->email); 
        $address = $this->ObjConnection->real_escape_string($values->input->address); 
        $zipcode = $this->ObjConnection->real_escape_string($values->input->zipcode); 
      
        $customer = new Customer(NULL, $username, $password, $name, $email, $address, $zipcode);
        
        $sql = "INSERT INTO ws_customer (id, username, password, name, email, address, zipcode) VALUES ('', '{$customer->username}', '{$customer->password}', '{$customer->name}', '{$customer->email}', '{$customer->address}', '{$customer->zipcode}')";
                
        if($this->query($sql)){
          return true;
        } else {
            return false;
        }
    }
    
    public function postProduct($input){
        // Create output using input
        $values = (object)array(
            'input' => json_decode($input)
        );
      
        $categoryId = $this->ObjConnection->real_escape_string($values->input->category->categoryId);
        $categoryName = $this->ObjConnection->real_escape_string($values->input->category->categoryName);
        
        $productName = $this->ObjConnection->real_escape_string($values->input->productName);
        $price = $this->ObjConnection->real_escape_string($values->input->price);
        $productDescription = $this->ObjConnection->real_escape_string($values->input->productDescription); 
        $amount = $this->ObjConnection->real_escape_string($values->input->amount);
      
        $category = new Category($categoryId, $categoryName);
        $product = new Product($productName, $price, $productDescription, NULL, $category, $amount);
        
        $sql = "INSERT INTO ws_product (productname, price, productdescription, category_id, product_amount) VALUES ("
                . "'{$product->productName}', "
                . "{$product->price}, "
                . "'{$product->productDescription}', "
                . "{$product->category->categoryId}, "
                . "{$product->amount}"
                . ")";
                
        if($this->query($sql)){
            $product->productId = $this->ObjConnection->insert_id;
            return $product;
        } else {
            return FALSE;
        }
    }
  
  public function deleteProduct($productId){
    
    $id = $this->ObjConnection->real_escape_string($productId);
    
    $sql = "DELETE from ws_product WHERE id = {$id}";
    if($this->query($sql)){
      return true;
    } else {
      return false;
    }
  }
  
  public function updateProduct($input){
    
    $values = (object)array(
      'input' => json_decode($input)
    );
    
    $categoryId = $this->ObjConnection->real_escape_string($values->input->category->categoryId);
    $categoryName = $this->ObjConnection->real_escape_string($values->input->category->categoryName);
    
    $productId = $values->input->productId;
    $productName = $this->ObjConnection->real_escape_string($values->input->productName);
    $price = $this->ObjConnection->real_escape_string($values->input->price);
    $productDescription = $this->ObjConnection->real_escape_string($values->input->productDescription); 
    $amount = $this->ObjConnection->real_escape_string($values->input->amount);
      
    $category = new Category($categoryId, $categoryName);
    $product = new Product($productName, $price, $productDescription, $productId, $category, $amount);
        
    $sql = "UPDATE ws_product SET productname = '{$product->productName}', price = {$product->price}, productdescription = '{$product->productDescription}', category_id = {$product->category->categoryId}, product_amount = {$product->amount} WHERE id = {$product->productId}";
                
    if($this->query($sql)){
      return $product;
    } else {
      return false;
    }
    
  }
  
  public function updateOrder($input){
        // Create output using input
        $values = (object)array(
            'input' => json_decode($input)
        );
        
        $id = $values->input->id;
        $dt = $values->input->timestamp;
        $customerId = $values->input->customerId;      
      
        $order = new Order($id, $customerId, $dt);
        
        $sql = "UPDATE ws_order SET status_id = 2 WHERE id = {$id}";
                
        $this->query($sql);
    }
  
  public function updateCustomer($input){
        // Create output using input
        $values = (object)array(
            'input' => json_decode($input)
        );
        
        $id = $this->ObjConnection->real_escape_string($values->input->id);
        $username = $this->ObjConnection->real_escape_string($values->input->username);
        $password = $this->ObjConnection->real_escape_string($values->input->password);
        $name = $this->ObjConnection->real_escape_string($values->input->name);   
        $email = $this->ObjConnection->real_escape_string($values->input->email); 
        $address = $this->ObjConnection->real_escape_string($values->input->address); 
        $zipcode = $this->ObjConnection->real_escape_string($values->input->zipcode); 
      
        $customer = new Customer($id, $username, $password, $name, $email, $address, $zipcode);
        
        $sql = "UPDATE ws_customer SET username = '{$customer->username}', password = '{$customer->password}', name = '{$customer->name}', email = '{$customer->email}', address = '{$customer->address}', zipcode = {$customer->zipcode} WHERE id = {$id}";
                
        if($this->query($sql)){
          return $customer;
        } else {
            return false;
        }
    }
  
}