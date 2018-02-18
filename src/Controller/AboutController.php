<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController.
 */
class AboutController extends Controller
{
    /**
     * @Route("/about", name="about")
     * @Template("homepage/about.html.twig")
     *
     * @return array
     */
    public function aboutAction(Request $request)
    {
        return;
    }
}
