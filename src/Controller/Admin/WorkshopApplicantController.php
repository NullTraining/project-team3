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
use FOS\UserBundle\Model\UserManager;
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
                'required' => true,
            ])
            ->add('ok', SubmitType::class)
            ->getForm();
    
    
        $form->handleRequest($this->request);
        if ($form->isSubmitted() && $form->isValid()) {
    
            /**
             * @var $userManager UserManager
             */
            $userManager = $this->get('fos_user.user_manager');
            $newUser = $userManager->createUser();
            $newUser->setUsername($applicantEntity->getContactEmailAddress());
            $newUser->setEmail($applicantEntity->getContactEmailAddress());
            $newUser->setEmailCanonical($applicantEntity->getContactEmailAddress());
            $newUser->setEnabled(true);
            $ti = $userManager->updateUser($newUser);
            $ja = '';
            die('submit');
        }
        
        
        return $this->render('admin/workshop-applicant/confirm-approve.html.twig', [
            'entity' => $applicantEntity,
            'form'   => $form->createView(),
        ]);
    }
}
