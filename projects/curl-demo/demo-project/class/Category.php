<?php
class Category{
    public $categoryId;
    public $categoryName;
    
    function __construct($id, $name=null){
        $this->categoryId = $id;
        $this->categoryName = $name;
    }
}