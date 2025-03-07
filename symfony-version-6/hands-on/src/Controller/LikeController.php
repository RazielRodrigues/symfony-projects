<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    #[Route('/like/{id}', name: 'app_like')]
    public function like(MicroPost $microPost, MicroPostRepository $microPostRepository, Request $request): Response
    {
        $currentUser = $this->getUser();
        $microPost->addLikedBy($currentUser);
        $microPostRepository->add($microPost, true);
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('/unlike/{id}', name: 'app_unlike')]
    public function unlike(MicroPost $microPost, MicroPostRepository $microPostRepository, Request $request): Response
    {
        $currentUser = $this->getUser();
        $microPost->removeLikedBy($currentUser);
        $microPostRepository->add($microPost, true);
        return $this->redirect($request->headers->get('referer'));
    }
}
