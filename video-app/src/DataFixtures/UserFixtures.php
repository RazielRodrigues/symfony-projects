<?php
/*
|--------------------------------------------------------
| copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------
*/
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $password_encoder)
    {
        $this->password_encoder = $password_encoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$name, $last_name, $email, $password, $api_key, $roles])
        {
            $user = new User();
            $user->setName($name);
            $user->setLastName($last_name);
            $user->setEmail($email);
            $user->setPassword($this->password_encoder->encodePassword($user, $password));
            $user->setVimeoApiKey($api_key);
            $user->setRoles($roles);

            $manager->persist($user);
        }
        $manager->flush();
    }

    private function getUserData(): array
    {
        return [

            ['John', 'Wayne', 'jw@symf4.loc', 'passw', 'hjd8dehdh', ['ROLE_ADMIN']],
            ['John', 'Wayne2', 'jw2@symf4.loc', 'passw', null, ['ROLE_ADMIN']],
            ['John', 'Doe', 'jd@symf4.loc', 'passw', null, ['ROLE_USER']],
            ['Ted', 'Bundy', 'tb@symf4.loc', 'passw', null, ['ROLE_USER']] 
           

        ];
    }
}

