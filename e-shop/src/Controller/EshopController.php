<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EshopController extends AbstractController
{
    /**
     * @Route("/", name="eshop")
     */
    public function index(): Response
    {
        return $this->render('eshop/index.html.twig', [
            'controller_name' => 'EshopController',
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(): Response
    {
        sleep(3);
        return new Response("search...");
    }

    /**
     * @Route("/signup-sms", name="signup-sms")
     */
    public function SignUpSMS(): Response
    {
        $phoneNumber = '111 222 333';
        sleep(3);
        return new Response("phone: {$phoneNumber}");
    }

    /**
     * @Route("/order", name="order")
     */
    public function order(): Response
    {
        $productId = 1;
        sleep(3);
        return new Response("Product ID: {$productId}");
    }

}
