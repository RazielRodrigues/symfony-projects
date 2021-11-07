<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use App\Entity\Users;

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

    /**
     * @Route("/user/create/{name}", name="user_create")
     */
    public function createUserDatabase(Request $request)
    {
        $name = $request->get('name');
        $user = new Users();
        $user->setName($name);
        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('user_read');
    }


    /**
     * @Route("/user/", name="user_read")
     */
    public function readUserDatabase(UsersRepository $user)
    {
        return $this->json($user->findAll());
    }


}
