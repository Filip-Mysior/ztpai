<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SetController extends AbstractController
{
    #[Route('/set', name: 'app_set')]
    public function index(): Response
    {
        return $this->render('set/index.html.twig', [
            'controller_name' => 'SetController',
        ]);
    }

    #[Route('/set/learn', name: 'app_set_learn')]
    public function learn(): Response
    {
        return $this->render('set/learn.html.twig', [
            'controller_name' => 'SetController',
        ]);
    }
}
