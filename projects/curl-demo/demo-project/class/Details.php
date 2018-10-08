<?php
class Details{
		public $price, $amount, $orderId, $productId, $order;
    
    function __construct($price, $amount, $orderId, $productId, Order $order = NULL) {
        $this->price = $price;
        $this->amount = $amount;
        $this->orderId = $orderId;
        $this->productId = $productId;
				$this->order = $order;
    }
}