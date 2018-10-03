<?php
class Status{
    public $statusId;
    public $statusName;
    
    function __construct($id, $name=null){
        $this->statusId = $id;
        $this->statusName = $name;
    }
}