<?php

namespace App\Controller;

use App\Model\Data;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{

    #[Route('/api')]
    public function getCollection(): Response
    {
        return $this->json(
            [
                new Data(
                    1,
                    'Raziel',
                    25
                ),
                new Data(
                    1,
                    'Raziel',
                    25
                )
            ]
        );
    }
}
