<?php

namespace App\Controller;

use App\Entity\CartLine;
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
     */
    #[Route('/cart/add/{product}/{quantity}', name: 'app_category_category_products_add_number')]
    public function addProductToCart(int $product, int $quantity, ProductRepository $productRepository, CartRepository $cartRepository, CartLineRepository $cartLineRepository, EntityManagerInterface $manager): Response
    {
        try {
            $manager->beginTransaction();

            $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);
            $cartLine = $cartLineRepository->findCartLineByProduct($product);

            if ($cartLine) {

                $cartLine->setQuantity($cartLine->getQuantity()+$quantity);
                $manager->persist($cartLine);
            } else {

                $cartLine = new CartLine();
                $cartLine->setProduct($productRepository->findOneBy(['id' => $product]));
                $cartLine->setCart($cart);
                $cartLine->setQuantity($quantity);
                $manager->persist($cartLine);

                $cart->addCartLine($cartLine);
            }

            $manager->flush();

        }
        catch (Exception $exception) {
            $manager->rollback();
            throw new Exception($exception);
        }

        return $this->redirectToRoute('app_cart');

    }
}
