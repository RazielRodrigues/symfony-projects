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
        //? Return to a page with parameter to access from twig
        // return $this->render('default/index.html.twig', ['controller_name' => 'DefaultController',]);
        //? Return a json string
        // return $this->json(['controller_name' => 'DefaultController',]);
        //? Redirect to a link
        // return $this->redirect('google.com');
         //? Redirect to a  Route with or not paramaters
        // return $this->redirectToRoute('default2');
        return new Response("Hello {$name}");
    }

    /**
     * @Route("/default2", name="default2")
     */
    public function index2(): Response
    {
        //? Create a new response object
        return new Response('from controller default 1');
    }

}
