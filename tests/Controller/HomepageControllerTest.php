<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class HomepageControllerTest
 *
 * @package App\Tests\Controller
 */
class HomepageControllerTest extends WebTestCase
{
    public function testHomepageWhenWorkshopsDoNotExist()
    {
        $url = '/';
        $content = '';
        
        $client = self::createClient();
        
        $client->request('GET', $url);
        
        $response = $client->getResponse();
        
        if ($response) {
            $content = $response->getContent();
        }
        
        self::assertContains('Null Training - Team 3', $content);
    }
}
