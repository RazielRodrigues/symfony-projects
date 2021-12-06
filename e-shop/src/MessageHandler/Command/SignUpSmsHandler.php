<?php

namespace App\MessageHandler\Command;

use App\Message\Command\SignUpSms;

class SignUpSmsHandler
{

    public function __invoke(SignUpSms $signUpSms)
    {
        sleep(4);
        dump($signUpSms);    
    }

}
