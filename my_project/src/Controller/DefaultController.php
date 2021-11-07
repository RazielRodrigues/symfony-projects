<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default/{name}", name="default")
     */
    public function index($name): Response
    {
        return $this->render('default/index.html.twig', ['controller_name' => 'DefaultController']);
    }

    /**
     * @Route("/default2", name="default2")
     */
    public function index2(): Response
    {
        return new Response('from controller default 1');
    }

}
