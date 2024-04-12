<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HeadphonesController extends AbstractController
{
    #[Route('/headphones', name: 'app_headphones')]
    public function index(): Response
    {
        return $this->render('headphones/index.html.twig', [
            'controller_name' => 'HeadphonesController',
        ]);
    }
}
