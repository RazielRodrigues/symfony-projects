<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FollowerController extends AbstractController
{
    #[Route('/follow/{id}', name: 'app_follow')]
    public function follow(
        User $userToFollow,
        ManagerRegistry $managerRegistry,
        Request $request,
    ): Response {

        /** @var User $currentUser */
        $currentUser = $this->getUser();

        if ($currentUser->getId() != $userToFollow->getId()) {
            $currentUser->follow($userToFollow);
            $managerRegistry->getManager()->flush();
        }

        return $this->redirect($request->headers->get('referee', '/micro-post'));
    }

    #[Route('/unfollow/{id}', name: 'app_unfollow')]
    public function unfollow(
        User $userToUnfollow,
        ManagerRegistry $managerRegistry,
        Request $request,
    ): Response {
        /** @var User $currentUser */
        $currentUser = $this->getUser();

        if ($currentUser->getId() != $userToUnfollow->getId()) {
            $currentUser->unfollow($userToUnfollow);
            $managerRegistry->getManager()->flush();
        }

        return $this->redirect($request->headers->get('referee', '/micro-post'));
    }
}
