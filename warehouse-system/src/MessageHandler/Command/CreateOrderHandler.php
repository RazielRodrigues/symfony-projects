<?php

namespace App\MessageHandler\Command;
use App\Message\Command\CreateOrder;

class CreateOrderHandler
{

    public function __invoke(CreateOrder $createOrder)
    {
        sleep(10);
    }

}
