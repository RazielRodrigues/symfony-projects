<?php

namespace App\Controller;

use App\Repository\DepartmentRepository;
use App\Repository\RegistrationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
final class DepartmentController extends AbstractController
{
    #[Route(name: 'app_department_index', methods: ['GET'])]
    public function index(DepartmentRepository $departmentRepository, RegistrationRepository $registrationRepository): Response
    {
        return $this->render('department/index.html.twig', [
            'departments' => $departmentRepository->findAll(),
            'registrations' => $registrationRepository->findAll()
        ]);
    }

}
