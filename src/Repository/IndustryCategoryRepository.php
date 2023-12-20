<?php

namespace App\Repository;

use App\Entity\IndustryCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IndustryCategory>
 *
 * @method IndustryCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndustryCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndustryCategory[]    findAll()
 * @method IndustryCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndustryCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndustryCategory::class);
    }

//    /**
//     * @return IndustryCategory[] Returns an array of IndustryCategory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?IndustryCategory
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
