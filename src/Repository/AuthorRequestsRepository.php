<?php

namespace App\Repository;

use App\Entity\AuthorRequests;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AuthorRequests|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthorRequests|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthorRequests[]    findAll()
 * @method AuthorRequests[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRequestsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuthorRequests::class);
    }

    // /**
    //  * @return AuthorRequests[] Returns an array of AuthorRequests objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AuthorRequests
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
