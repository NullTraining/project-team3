<?php

declare(strict_types=1);
/**
 * User: leonardvujanic
 * DateTime: 31/01/2018 18:46.
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ScheduleController.
 */
class ScheduleController
{
    /**
     * @Route("/schedule", name="schedule_index")
     * @Template("schedule/index.html.twig")
     */
    public function indexAction()
    {
        return [];
    }
}
