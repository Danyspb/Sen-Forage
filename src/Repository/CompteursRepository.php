<?php

namespace App\Repository;

use App\Entity\Compteurs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Compteurs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compteurs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compteurs[]    findAll()
 * @method Compteurs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Compteurs::class);
    }

    // /**
    //  * @return Compteurs[] Returns an array of Compteurs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Compteurs
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
