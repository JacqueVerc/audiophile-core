<?php

namespace App\Controller;

use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/media')]
class MediaController extends AbstractController
{
    #[Route('/liste-media', name: 'media_liste')]
    public function listeMedia(MediaRepository $mediaRepository): Response
    {
        $medias = $mediaRepository->findAll();

        $page = $this->renderView('Media/liste_media.html.twig',
            [
                'medias' => $medias
                ]
        );

        return new Response($page);
    }
}
