<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController
 *
 * @package App\Controller
 */
class AboutController extends Controller
{
    
    /**
     * @Route("/about", name="about")
     * @Template("homepage/about.html.twig")
     */
    public function aboutAction()
    {
    
    }
}
