<?php
/**
 * User: leonardvujanic
 * DateTime: 22/01/2018 22:56
 *
 *
 */

namespace App\EventListener;

use App\Entity\WorkshopApplicant;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Class EasyAdminSubscriber
 *
 * @package App\EventListener
 */
class EasyAdminSubscriber implements EventSubscriberInterface
{
    
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'easy_admin.post_update' => [
                'inviteWorkshopApplicant',
            ],
        ];
    }
    
    
    /**
     * @param GenericEvent $event
     */
    public function inviteWorkshopApplicant(GenericEvent $event)
    {
        $entity = $event->getSubject();
        
        if (!($entity instanceof WorkshopApplicant)) {
            return;
        }
        
        if($entity->getIsApproved() === false) {
            // send mail
        }
    }
}
