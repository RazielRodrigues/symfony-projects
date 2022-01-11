<?php
/*
|--------------------------------------------------------
| copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------
*/
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\RoleUser;
use App\Entity\User;

class AdminControllerUserAccountTest extends WebTestCase
{
    use RoleUser;

    public function testUserDeletedAccount()
    {
        $crawler = $this->client->request('GET', '/admin/delete-account');

        $user = $this->entityManager->getRepository(User::class)->find(3);
        $this->assertNull($user);
    }

    public function testUserChangedPassword()
    {

        $crawler = $this->client->request('GET', '/admin/');

        $form = $crawler->selectButton('Save')->form([

            'user[name]' => 'name',
            'user[last_name]' => 'last name',
            'user[email]' => 'email@email.email',
            'user[password][first]' => 'password',
            'user[password][second]' => 'password'
        ]);
        $this->client->submit($form);

       $user = $this->entityManager->getRepository(User::class)->find(3);

        $this->assertSame('name',$user->getName());

    }

}
