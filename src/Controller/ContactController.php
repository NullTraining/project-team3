<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ContactController
 *
 * @package App\Controller
 */
class ContactController extends Controller
{


    /**
     * @Route("/contact", name="contact")
     * @Template("homepage/contact.html.twig")
     * @return array
     */

    public function contactAction(Request $request)
    {


        $form = $this->createFormBuilder()
            ->add("Name", TextType::class)
            ->add("E-mail", EmailType::class)
            ->add("Message", TextareaType::class)
            ->add("Send", SubmitType::class, array("label" => "Send message"))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactData = $form->getData();

            //TODO: send mail after configuring mailgun
        }

        return $this->render("homepage/contact.html.twig", array("form" => $form->createView(),));
    }


}
