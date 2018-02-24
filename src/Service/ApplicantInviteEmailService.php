<?php

declare(strict_types=1);
/**
 * User: leonardvujanic
 * DateTime: 31/01/2018 18:04.
 */

namespace App\Service;

use App\Entity\WorkshopApplicant;
use Swift_Mailer;
use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * Class ApplicantInviteEmailService.
 */
class ApplicantInviteEmailService
{
    /** @var Swift_Mailer */
    private $mailer;
    /**
     * @var TwigEngine
     */
    private $templating;

    public function __construct(Swift_Mailer $mailer, TwigEngine $templating)
    {
        $this->mailer     = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param WorkshopApplicant $entity
     * @param string            $link
     *
     * @throws \Twig\Error\Error
     */
    public function notify(WorkshopApplicant $entity, string $link)
    {
        $body = $this->templating->render('emails/invite.html.twig', [
            'entity'     => $entity,
            'inviteLink' => $link,
        ]);

        $message = (new \Swift_Message('Wellcome to Null training - TEAM 3'))
            ->setFrom('team3.nt@gmail.com')
            ->setTo($entity->getContactEmailAddress())
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }
}
