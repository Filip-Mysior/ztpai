<?php

namespace App\Controller;

use App\Repository\UserTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(UserTypeRepository $userRepository): Response
    {
        $userTypes = $userRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'user_types' => $userTypes,
        ]);
    }
}
