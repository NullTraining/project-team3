<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class HomepageControllerTest extends WebTestCase
{

    public function testHomepage()
    {
        $url = '/';

        $client = self::createClient();

        $client->request('GET', $url);

        self::assertEquals('{"id":1,"name":"John"}', $client->getResponse()->getContent());
    }
}