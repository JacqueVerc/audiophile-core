<?php

namespace App\Processor;

use App\Entity\Cart;
use App\Entity\CartLine;
use App\Repository\CartLineRepository;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Component\Security\Core\User\UserInterface;

class CartProcessor
{

    public function __construct(
        private EntityManagerInterface $manager,
        private ProductRepository $productRepository,
        private CartRepository $cartRepository,
        private CartLineRepository $cartLineRepository,
    )
    {}

    /**
     * @throws OptimisticLockException
     * @throws Exception
     * @throws ORMException
     */
    public function addToCart(Cart $cart, ?CartLine $cartLine, int $product, int $quantity): void
    {
        try {
            $this->manager->beginTransaction();

            if ($cartLine) {
                $cartLine->setQuantity($cartLine->getQuantity() + $quantity);
                $this->manager->persist($cartLine);
            } else {

                $cartLine = new CartLine();
                $cartLine->setProduct($this->productRepository->findOneBy(['id' => $product]));
                $cartLine->setCart($cart);
                $cartLine->setQuantity($quantity);
                $this->manager->persist($cartLine);

                $cart->addCartLine($cartLine);
            }
            $this->manager->flush();
            $this->manager->commit();

        } catch (Exception $exception){

            $this->manager->rollback();
            throw $exception;

        }
    }

    public function getCart(UserInterface $user): array
    {
        $cart = $this->cartRepository->findOneBy(['user' => $user]);

        $cartLines = $this->cartLineRepository->findBy(['cart' => $cart]);

        $sum = 0;
        $quantity = 0;
        $taxes = 90;
        $shipping = 50;

        foreach ($cartLines as $cartLine) {
            $sum += ($cartLine->getQuantity() * $cartLine->getProduct()->getPrice());
            $quantity += $cartLine->getQuantity();
        }

        $totalSum = $sum + $taxes + $shipping;

        return [
            'cartLines' => $cartLines,
            'sum' => $sum,
            'quantity' => $quantity,
            'totalSum' => $totalSum,
            'taxes' => $taxes,
            'shipping' => $shipping,
            ];
    }
}