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
use FOS\UserBundle\Util\TokenGenerator;
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
    private $userRepository;
    
    /**
     * WorkshopApplicantController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function approveAction()
    {
        $easyadmin = $this->request->attributes->get('easyadmin');
        /**
         * @var $applicantEntity WorkshopApplicant
         */
        $applicantEntity = $easyadmin['item'];
        
        $user = $this->userRepository->findByUsername($applicantEntity->getContactEmailAddress());
        
        if ($user !== null) {
            return $this->render('admin/workshop-applicant/confirm-approve.html.twig', [
                'entity' => $applicantEntity,
                'error'  => [
                    'success' => false,
                    'msg'     => 'Ooops! User all ready in database.',
                ],
            ]);
        }
        
        $form = $this->createFormBuilder()
            ->add('confirm_invite', HiddenType::class, [
                'data'     => 1,
                'required' => true,
            ])
            ->add('ok', SubmitType::class)
            ->getForm();
        
        
        $form->handleRequest($this->request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $tokenGenerator = new TokenGenerator();
            $token = $tokenGenerator->generateToken();
            
            /**
             * @var $userManager UserManager
             */
            $userManager = $this->get('fos_user.user_manager');
            $newUser = $userManager->createUser();
            $newUser->setUsername($applicantEntity->getContactEmailAddress());
            $newUser->setEmail($applicantEntity->getContactEmailAddress());
            $newUser->setEmailCanonical($applicantEntity->getContactEmailAddress());
            $newUser->setEnabled(false);
            $newUser->setPlainPassword($token);
            $newUser->setConfirmationToken($token);
            try {
                $userManager->updateUser($newUser);
                /**
                 * Created 30/01/2018
                 * TODO[leovujanic] - send email here
                 */
                $success = true;
                $msg = 'User successfully invited.';
            } catch (\Exception $e) {
                $success = false;
                $msg = 'Ooops! Something went wrong';
            }
            
            return $this->render('admin/workshop-applicant/confirm-approve.html.twig', [
                'entity' => $applicantEntity,
                'error'  => [
                    'success' => $success,
                    'msg'     => $msg,
                ],
            ]);
        }
        
        return $this->render('admin/workshop-applicant/confirm-approve.html.twig', [
            'entity' => $applicantEntity,
            'form'   => $form->createView(),
        ]);
    }
    
}
