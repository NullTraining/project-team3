<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class HomepageController
{

    public function indexAction()
    {
        return new JsonResponse(['id'=>1,'name'=>'John']);
    }

    /**
     * @Route("/hello")
     */
    public function helloAction()
    {
        return new Response('Hello');
    }
}