<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SpeakersController extends AbstractController
{
    #[Route('/speakers', name: 'app_speakers')]
    public function index(): Response
    {
        return $this->render('speakers/index.html.twig', [
            'controller_name' => 'SpeakersController',
        ]);
    }
}
