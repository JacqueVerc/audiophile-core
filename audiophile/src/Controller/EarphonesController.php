<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EarphonesController extends AbstractController
{
    #[Route('/earphones', name: 'app_earphones')]
    public function index(): Response
    {
        return $this->render('earphones/index.html.twig', [
            'controller_name' => 'EarphonesController',
        ]);
    }
}
