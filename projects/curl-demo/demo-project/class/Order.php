<?php
class Order{
		public $id, $timestamp, $customerId, $status;
    
    function __construct($id=NULL, $customerId, $timestamp, Status $status = null) {
			$this->id = $id;
      $this->customerId = $customerId;
      $this->timestamp = $timestamp;
			$this->status = $status;
    }
}