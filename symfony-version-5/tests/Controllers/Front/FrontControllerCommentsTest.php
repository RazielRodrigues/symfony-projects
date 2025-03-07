<?php
/*
|--------------------------------------------------------
| copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------
*/
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\RoleAdmin;

class FrontControllerCommentsTest extends WebTestCase
{
    use RoleAdmin;

    public function testNotLoggedInUser()
    {
        $client = static::createClient();
        $client->followRedirects();
        
        $crawler = $client->request('GET', '/video-details/16');

        $form = $crawler->selectButton('Add')->form([
            'comment' => 'Test comment'
        ]);
        $client->submit($form);

        $this->assertContains( 'Please sign in', $client->getResponse()->getContent() );
    }


    public function testNewCommentAndNumberOfComments()
    {
 
        $this->client->followRedirects();

        $crawler = $this->client->request('GET', '/video-details/16');

        $form = $crawler->selectButton('Add')->form([
            'comment' => 'Test comment',
        ]);
        $this->client->submit($form);

        $this->assertContains( 'Test comment', $this->client->getResponse()->getContent() );

        $crawler = $this->client->request('GET', '/video-list/category/toys,2');
        $this->assertSame('Comments (1)', $crawler->filter('a.ml-1')->text());
        
    }
}

