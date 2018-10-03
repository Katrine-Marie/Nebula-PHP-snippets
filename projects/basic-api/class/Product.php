<?php
class Product{
    public $productId;
    public $productName;
    public $price;
    public $productDescription;
    public $amount;
    public $category;
    
    function __construct($productName, $price, $productDescription, $productId=NULL, Category $category = NULL, $amount=null) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->price = $price;
        $this->productDescription = $productDescription;
        $this->amount = $amount;
        $this->category = $category;
    }
}