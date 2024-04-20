<?php

namespace App\Processor;

use App\Entity\Cart;
use App\Entity\CartLine;
use App\Repository\ProductRepository;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

class CartProcessor
{

    public function __construct(
        private EntityManagerInterface $manager,
        private ProductRepository $productRepository
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
}