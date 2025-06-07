<?php

namespace App\Controller;

use App\Entity\Department;
use App\Entity\Registration;
use App\Form\RegistrationForm;
use App\Service\CheckAmountPeople;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/registration')]
final class RegistrationController extends AbstractController
{
    #[Route('/{department}', name: 'app_registration', methods: ['GET', 'POST'])]
    public function register(Request $request, EntityManagerInterface $entityManager, Department $department, CheckAmountPeople $checkAmountPeople): Response
    {
        $registration = new Registration();
        $form = $this->createForm(RegistrationForm::class, $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // I wanted to create a service to send the email but I had no time :(
            if ($checkAmountPeople->checkPeople($form)) {
                $form->get('number_vegetarians')->addError(new FormError("Vegetarians number exceed number of people is that correct?"));
                return $this->render('registration/new.html.twig', [
                    'registration' => $registration,
                    'form' => $form,
                    'department' => $department?->getId()

                ]);
            }

            try {
                // Since is not saying to make a relationship is just the name I will save like that
                // It also prevents from departments that does not exists otherwise I will need to check in the
                // database and it will need more time
                $registration->setDepartment($department->getName());
                $entityManager->persist($registration);
                $entityManager->flush();

                return $this->redirectToRoute('app_registration', ['department' => $department->getId()]);
            } catch (UniqueConstraintViolationException $e) {
                $form->get('email')->addError(new FormError("I think you're already registered!"));
            }
        }

        return $this->render('registration/new.html.twig', [
            'registration' => $registration,
            'form' => $form,
            'department' => $department->getId()
        ]);
    }
}
