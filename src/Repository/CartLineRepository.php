<?php

namespace App\Repository;

use App\Entity\CartLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
        public function findCartLineByProduct(int $product): ?CartLine
        {
            return $this->createQueryBuilder('cali')
                ->innerJoin('cali.product', 'prod')
                ->andWhere('prod.id = :product')
                ->setParameter('product', $product)
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
