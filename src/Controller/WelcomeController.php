<?php declare(strict_types=1);
/**
 * User: leonardvujanic
 * DateTime: 29/01/2018 23:12
 *
 *
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * Class WelcomeController
 *
 * @package Controller
 */
class WelcomeController extends Controller
{
    /**
     * @Route("/welcome", name="welcome_set_password")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function setPasswordAction(Request $request)
    {
        $token = $request->get('token');
        
        if ($token === null) {
            throw new \Exception('No token');
        }
        
        
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserByConfirmationToken($token);
        
        if ($user === null) {
            throw new \Exception('No user found');
        }
        
        $form = $this->createFormBuilder()
            ->add('password', RepeatedType::class, [
                'type'            => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options'         => ['attr' => ['class' => 'password-field']],
                'required'        => true,
                'first_options'   => ['label' => 'Password'],
                'second_options'  => ['label' => 'Repeat Password'],
            ])
            ->add('confirm', SubmitType::class)
            ->getForm();
        
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // set user password
            $user->setConfirmationToken(null);
            $user->setPlainPassword($form->getData()['password']);
            $user->setEnabled(true);
            $userManager->updateUser($user);
            
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('session')->set('_security_main', serialize($token));
    
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));
            
            // Fire the login event manually
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch('security.interactive_login', $event);
            
            return $this->render(
                'welcome/welcome.html.twig'
            );
        }
        
        return $this->render(
            'welcome/set-password.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
