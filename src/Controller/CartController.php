<?php

namespace App\Controller;

use App\Entity\CartLine;
use App\Processor\CartProcessor;
use App\Repository\CartLineRepository;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Exception;
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

        $sum = 0;

        foreach ($cartLines as $cartLine) {
            $sum += ( $cartLine->getQuantity() * $cartLine->getProduct()->getPrice() );
        }

        return $this->render('cart/index.html.twig', [
            'cartLines' => $cartLines,
            'sum' => $sum
        ]);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    #[Route('/cart/add/{product}/{quantity}', name: 'app_category_category_products_add_number')]
    public function addProductToCart(int $product, int $quantity, CartRepository $cartRepository, CartLineRepository $cartLineRepository, CartProcessor $cartProcessor): Response
    {
            $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);
            $cartLine = $cartLineRepository->findCartLineByProduct($product);
            $cartProcessor->addToCart($cart, $cartLine, $product, $quantity);

        return $this->redirectToRoute('app_cart');

    }
}
