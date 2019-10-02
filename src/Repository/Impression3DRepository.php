<?php

namespace App\Repository;

use App\Entity\Impression3D;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Impression3D|null find($id, $lockMode = null, $lockVersion = null)
 * @method Impression3D|null findOneBy(array $criteria, array $orderBy = null)
 * @method Impression3D[]    findAll()
 * @method Impression3D[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Impression3DRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Impression3D::class);
    }

    // /**
    //  * @return Impression3D[] Returns an array of Impression3D objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Impression3D
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
