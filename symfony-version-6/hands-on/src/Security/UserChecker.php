<?php

namespace App\Security;

use DateTime;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;

class UserChecker implements UserCheckerInterface
{

    /**
     * @param User $user
     */
    public function checkPreAuth(UserInterface $user): void
    {

        if (null === $user->getBannedUntil()) {
            return;
        }

        $now = new DateTime();

        if ($now < $user->getBannedUntil()) {
            throw new AccessDeniedException('Banned brother!');
        }
    }

    /**
     * @param User $user
     */
    public function checkPostAuth(UserInterface $user): void
    {
    }
}
