<?php

namespace App\Message\Command;

class SignUpSms
{
    private $phoneNumber;

    public function __construct($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Get the value of phoneNumber
     */ 
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
}
