<?php

namespace App\Controller;

use App\Repository\CartLineRepository;
use App\Repository\CartRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function getCartLines(UserRepository $userRepository, CartRepository $cartRepository, CartLineRepository $cartLineRepository): Response
    {
        $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);

        $cartLines = $cartLineRepository->findBy(['cart' => $cart]);

//        Attention CartLines est un tableau d'entité
        return $this->render('cart/index.html.twig', [
            'cartLines' => $cartLines
        ]);
    }
}
