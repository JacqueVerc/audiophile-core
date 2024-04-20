<?php

namespace App\Repository;

use App\Entity\CartLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<CartLine>
 *
 * @method CartLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartLine[]    findAll()
 * @method CartLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartLine::class);
    }

        /**
         * @return CartLine[] Returns an array of CartLine objects
         */
        public function findCartLineByProductAndCart(int $product, string $user): ?CartLine
        {
            return $this->createQueryBuilder('cali')
                ->innerJoin('cali.product', 'prod')
                ->innerJoin('cali.cart', 'cart')
                ->innerJoin('cart.user', 'user')
                ->andWhere('prod.id = :product')
                ->andWhere('user.email = :user')
                ->setParameter('product', $product)
                ->setParameter('user', $user)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }

    //    public function findOneBySomeField($value): ?CartLine
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
