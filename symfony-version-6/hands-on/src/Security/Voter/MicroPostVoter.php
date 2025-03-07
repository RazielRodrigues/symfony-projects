<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Entity\MicroPost;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class MicroPostVoter extends Voter
{

    public function __construct(private Security $security)
    {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [MicroPost::EDIT, MicroPost::VIEW])
            && $subject instanceof \App\Entity\MicroPost;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        /** @var User $user */
        $user = $token->getUser();

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        $isAuth = $user instanceof UserInterface;

        switch ($isAuth) {
            case MicroPost::EDIT:
                return $isAuth && ($subject->getAuthor()->getId() === $user->getId() || $this->security->isGranted('ROLE_EDITOR'));
            case MicroPost::VIEW:

                if (!$subject->extraPrivacy) {
                    return true;
                }

                return
                    $isAuth &&
                    ($subject->getAuthor()->getFollows()->contains($user)
                        ||
                        $subject->getAuthor()->getId() === $user->getId()
                    );
        }

        return false;
    }
}
