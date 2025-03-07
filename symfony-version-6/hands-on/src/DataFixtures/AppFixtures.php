<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $user->setEmail('rz@night.com');
        $user->setPassword($this->userPasswordHasher->hashPassword($user, '12345678'));
        $manager->persist($user);

        $microPost = new MicroPost();
        $microPost->setTitle('PHP 8 AWESOME!');
        $microPost->setText('Lorem Ipsum Dolor');
        $microPost->setCreated(new DateTime());
        $microPost->setAuthor($user);
        $manager->persist($microPost);

        $comment = new Comment();
        $comment->setAuthor($user);
        $comment->setPost($microPost);
        $comment->setText('comentando...');

        $manager->flush();
    }
}
