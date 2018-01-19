<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomepageControllerTest extends WebTestCase
{
    
    public function testHomepageWhenWorkshopsDoNotExist()
    {
        $url = '/';
        
        $client = self::createClient();
        
        $client->request('GET', $url);
        
        self::assertContains('Null Training - Team 3', $client->getResponse()->getContent());
    }
}
