<?php

namespace App\Message\Command;

class CreateOrder
{
    private $productId;
    private $productAmount;

    public function __construct($productId, $productAmount) {
        $this->productId = $productId;
        $this->productAmount = $productAmount;
    }


    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Get the value of productAmount
     */ 
    public function getProductAmount()
    {
        return $this->productAmount;
    }

}
