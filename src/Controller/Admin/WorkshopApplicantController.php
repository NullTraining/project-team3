<?php
/**
 * User: leonardvujanic
 * DateTime: 23/01/2018 00:11
 *
 *
 */

namespace App\Controller\Admin;

use App\Entity\WorkshopApplicant;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class WorkshopApplicantController
 *
 * @package Controller\Admin
 */
class WorkshopApplicantController extends BaseAdminController
{
    /**
     * @var UserRepository
     */
    public $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function approveAction()
    {
        
        $id = $this->request->query->get('id');
        $easyadmin = $this->request->attributes->get('easyadmin');
        /**
         * @var $applicantEntity WorkshopApplicant
         */
        $applicantEntity = $easyadmin['item'];
        
        $user = $this->userRepository->findByUsername($applicantEntity->getContactEmailAddress());
        
        if ($user !== null) {
            throw new \Exception('User all ready in database.');
        }
        
        $form = $this->createFormBuilder()
            ->add('confirm_invite', HiddenType::class, [
                'data' => 1,
            ])
            ->add('ok', SubmitType::class)
            ->getForm();
        
        
        //        $editForm->handleRequest($this->request);
        //        if ($editForm->isSubmitted() && $editForm->isValid()) {
        //            $this->dispatch(EasyAdminEvents::PRE_UPDATE, array('entity' => $entity));
        //
        //            $this->executeDynamicMethod('preUpdate<EntityName>Entity', array($entity));
        //            $this->em->flush();
        
        //            return $this->redirectToReferrer();
        //        }
        
        
        return $this->render('admin/workshop-applicant/confirm-approve.html.twig', [
            'entity' => $applicantEntity,
            'form'   => $form->createView(),
        ]);
    }
}
