<?php
/*
|-----------------------------------------------------------
| available only at Udemy.com | copyright netprogs.pl | further distribution is prohibited
|-----------------------------------------------------------
*/
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Tests\RoleAdmin;

class AdminControllerUsersTest extends WebTestCase
{
    use RoleAdmin;

    public function testUserDeleted()
    {
        $this->client->request('GET', '/admin/su/delete-user/4');
        $user = $this->entityManager->getRepository(User::class)->find(4);
        $this->assertNull($user);
    }
}

