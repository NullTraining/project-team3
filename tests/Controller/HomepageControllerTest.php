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
        
        self::assertContains('Currently, there are no active workshops', $client->getResponse()->getContent());
    }
}
