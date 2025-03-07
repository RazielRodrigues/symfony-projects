<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\HandleTrait;
use App\Message\Query\SearchQuery;
use App\Message\Command\CreateOrder;
use App\Message\Command\SignUpSms;

class EshopController extends AbstractController
{

    use HandleTrait;

    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus) {
        $this->messageBus = $messageBus;
    }

    /**
     * @Route("/", name="eshop")
     */
    public function index(): Response
    {
        return $this->render('eshop/index.html.twig');
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(): Response
    {
        $search = 'laptops';
        $result = $this->handle(new SearchQuery($search));
        return new Response("search: {$search} results: {$result}");
    }

    /**
     * @Route("/signup-sms", name="signup-sms")
     */
    public function SignUpSMS(): Response
    {
        $phoneNumber = '111 222 333';
        $this->messageBus->dispatch(new SignUpSms($phoneNumber));
        return new Response("phone: {$phoneNumber}");
    }

    /**
     * @Route("/order", name="order")
     */
    public function order(): Response
    {
        $productId = rand();
        $productName = 'ASUS NOTEBOOK';
        $productAmount = rand();
        $this->messageBus->dispatch(new CreateOrder($productId, $productAmount));
        return new Response("Product ID: {$productId}");
    }

}
