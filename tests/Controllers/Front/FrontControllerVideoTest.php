<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontControllerVideoTest extends WebTestCase
{
    public function testNoResults()
    {
        $client = static::createClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/');
    
        $form = $crawler->selectButton('Search video')->form([
            'query' => 'aaa',
        ]);
        $crawler = $client->submit($form);

        $this->assertContains('No results were found', $crawler->filter('h1')->text());
    }

    public function testResultsFound()
    {
        $client = static::createClient();
        $client->followRedirects();
        
        $crawler = $client->request('GET', '/');
    
        $form = $crawler->selectButton('Search video')->form([
            'query' => 'Movies',
        ]);
        $crawler = $client->submit($form);

        $this->assertGreaterThan(4, $crawler->filter('h3')->count());
    }

    public function testSorting()
    {
        $client = static::createClient();
        $client->followRedirects();
     
        $crawler = $client->request('GET', '/');
    
        $form = $crawler->selectButton('Search video')->form([
            'query' => 'Movies',
        ]);
        $crawler = $client->submit($form);

        $form = $crawler->filter('#form-sorting')->form([
            'sortby' => 'desc',
        ]);

        $crawler = $client->submit($form);

        $this->assertEquals('Movies 9', $crawler->filter('h3')->first()->text());
    }
}

