<?php

namespace App\Repository;

use App\Entity\ServiceHasCategoryService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ServiceHasCategoryService>
 *
 * @method ServiceHasCategoryService|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceHasCategoryService|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceHasCategoryService[]    findAll()
 * @method ServiceHasCategoryService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceHasCategoryServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceHasCategoryService::class);
    }

//    /**
//     * @return ServiceHasCategoryService[] Returns an array of ServiceHasCategoryService objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ServiceHasCategoryService
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
