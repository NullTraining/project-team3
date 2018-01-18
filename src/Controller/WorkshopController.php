<?php

namespace App\Controller;

use App\Entity\Workshop;
use App\Repository\WorkshopRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkshopController
{
    /** @var WorkshopRepository */
    private $workshopRepository;

    public function __construct(WorkshopRepository $workshopRepository)
    {
        $this->workshopRepository = $workshopRepository;
    }

    /**
     * @Route("/workshops", name="workshops_list")
     * @Template("workshop/workshops.html.twig")
     * @return array
     */
    public function indexWorkshops()
    {
        //return new Response('This is workshops page');
        return ['workshops' => $this->workshopRepository->findAll(),];
    }

}