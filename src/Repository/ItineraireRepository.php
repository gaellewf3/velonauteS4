<?php

namespace App\Repository;

use App\Entity\Itineraire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Itineraire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Itineraire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Itineraire[]    findAll()
 * @method Itineraire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItineraireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Itineraire::class);
    }

    // /**
    //  * @return Itineraire[] Returns an array of Itineraire objects
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
    public function findOneBySomeField($value): ?Itineraire
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
