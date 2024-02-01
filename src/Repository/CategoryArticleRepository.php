<?php

namespace App\Repository;

use App\Entity\CategoryArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoryArticleV2>
 *
 * @method CategoryArticleV2|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryArticleV2|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryArticleV2[]    findAll()
 * @method CategoryArticleV2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryArticle::class);
    }

//    /**
//     * @return CategoryArticleV2[] Returns an array of CategoryArticleV2 objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CategoryArticleV2
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
