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

   
   public function findAllInDateRange($startDate, $endDate): array
   {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM kilometers trip
            WHERE trip.date BETWEEN :startDate AND :endDate
            ORDER BY trip.date ASC
            ';

        $resultSet = $conn->executeQuery($sql, ['startDate' => $startDate, 'endDate' => $endDate]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
   }
}
