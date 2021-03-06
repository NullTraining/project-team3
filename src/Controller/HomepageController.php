<?php

namespace App\Controller;

use App\Repository\WorkshopRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class HomepageController.
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
     * @Template("homepage/index.html.twig")
     *
     * @return array
     */
    public function indexAction()
    {
        return ['workshops' => $this->repository->findAll()];
    }
}
