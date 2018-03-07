<?php
/**
 * User: leonardvujanic
 * DateTime: 19/01/2018 00:04.
 */

namespace App\Controller;

use App\Entity\WorkshopApplicant;
use App\Repository\WorkshopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WorkshopApplyController.
 */
class WorkshopApplyController extends Controller
{
    /**
     * @Route("/apply", name="workshop_apply")
     */
    public function applyAction(Request $request)
    {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('index');
        }

        $activeWorkshops = $this->get(WorkshopRepository::class)->getAllActiveWorkshops();

        $selectWorkshops = [];
        foreach ($activeWorkshops as $workshop) {
            $selectWorkshops[$workshop->getTitle()] = $workshop->getId();
        }

        $applicant = new WorkshopApplicant();

        $form = $this->createApplicantForm($applicant, $selectWorkshops);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($applicant);
            $em->flush();

            return $this->redirectToRoute('workshop_apply_thank_you');
        }

        return $this->render(
            'workshop/apply.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    protected function createApplicantForm(WorkshopApplicant $applicant, array $selectWorkshops)
    {
        $formBuilder = $this->createFormBuilder($applicant)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('contactEmailAddress', EmailType::class)
            ->add('contactPhoneNumber', TextType::class);
        if (!empty($selectWorkshops)) {
            $formBuilder->add('interestedIn', ChoiceType::class, [
                'choices'  => $selectWorkshops,
            ]);
        }

        return $formBuilder->getForm();
    }

    /**
     * @Route("/apply-thank-you", name="workshop_apply_thank_you")
     */
    public function applyThankYouAction()
    {
        return $this->render('workshop/apply-thank-you.html.twig');
    }
}
