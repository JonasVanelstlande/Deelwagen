<?php

namespace App\Repository;

use App\Entity\Kilometers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Kilometers>
 *
 * @method Kilometers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kilometers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kilometers[]    findAll()
 * @method Kilometers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KilometersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kilometers::class);
    }

//    /**
//     * @return Kilometers[] Returns an array of Kilometers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('k.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Kilometers
//    {
//        return $this->createQueryBuilder('k')
//            ->andWhere('k.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
