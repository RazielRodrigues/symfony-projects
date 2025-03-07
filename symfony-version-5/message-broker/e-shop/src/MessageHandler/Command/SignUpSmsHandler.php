<?php

namespace App\MessageHandler\Command;
use App\Message\Command\SignUpSms;

class SignUpSmsHandler
{

    public function __invoke(SignUpSms $signUpSms)
    {
        dump($signUpSms);    
    }

}
