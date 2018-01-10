<?php

namespace App\Controller;

use App\Repository\WorkshopRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomepageController
 *
 * @package App\Controller
 */
class HomepageController
{
    /**
     * @var WorkshopRepository
     */
    private $repository;
    
    /**
     * HomepageController constructor.
     *
     * @param WorkshopRepository $repository
     */
    public function __construct(WorkshopRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @Template("workshop/home.list.html.twig")
     * @return array
     */
    public function indexAction()
    {
        return ['workshops' => $this->repository->findAll(),];
    }
    
    /**
     * @Route("/hello")
     */
    public function helloAction()
    {
        return new Response('Hello');
    }
}
