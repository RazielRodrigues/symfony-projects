<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_main_page")
     */
    public function index(): Response
    {
        return $this->render('admin/my_profile.html.twig');
    }

    /**
     * @Route("/payment", name="payment")
     */
    public function payment(): Response
    {
        return $this->render('admin/payment.html.twig');
    }

    /**
     * @Route("/pricing", name="pricing")
     */
    public function pricing(): Response
    {
        return $this->render('admin/pricing.html.twig');
    }

}
