<?php

namespace App\Repository;

use App\Entity\PrixMed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrixMed|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrixMed|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrixMed[]    findAll()
 * @method PrixMed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrixMedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrixMed::class);
    }

    // /**
    //  * @return PrixMed[] Returns an array of PrixMed objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrixMed
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
