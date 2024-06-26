<?php

namespace App\Controller;

use App\Entity\Cart;
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
    public function getCartLines(CartProcessor $cartProcessor): Response
    {
        return $this->render('cart/index.html.twig', $cartProcessor->getCart($this->getUser()));
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove')]
    public function removeCartLine($id, CartLineRepository $cartLineRepository, EntityManagerInterface $entityManager): Response
    {
        $cartLine = $cartLineRepository->find($id);

        if ($cartLine) {
            if ($cartLine->getQuantity() > 1) {
                $cartLine->setQuantity($cartLine->getQuantity() - 1);
            } else {
                $entityManager->remove($cartLine);
            }

            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cart');
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function addProductToCart(int $id, CartRepository $cartRepository, CartLineRepository $cartLineRepository, CartProcessor $cartProcessor, UserRepository $userRepository, EntityManagerInterface $manager): Response
    {
        $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);

        if (!$cart) {
            $cart = new Cart();
            $cart->setUser($userRepository->findOneBy(['id' => $this->getUser()]));
            $manager->persist($cart);
            $manager->flush();
        }
        $cartLine = $cartLineRepository->findCartLineByProductAndCart($id, $this->getUser()->getUserIdentifier());
        $cartProcessor->addToCart($cart, $cartLine, $id, 1);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/clear', name: 'app_cart_clear')]
    public function clearCart(CartRepository $cartRepository, EntityManagerInterface $entityManager): Response
    {
        $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);

        if ($cart) {
            $cartLines = $cart->getCartLines();

            foreach ($cartLines as $cartLine) {
                $entityManager->remove($cartLine);
            }

            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cart');
    }
}
