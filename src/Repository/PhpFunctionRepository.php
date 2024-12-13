<?php

namespace App\Repository;

use App\Entity\PhpFunction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PhpFunction>
 */
class PhpFunctionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhpFunction::class);
    }

    /**
     * Récupère toutes les fonctions PHP d'une catégorie spécifique.
     *
     * @param string $categoryName
     * @return array
     */
    public function findByCategoryName(string $categoryName): array
    {
        return $this->createQueryBuilder('f')
            ->join('f.category', 'c')
            ->andWhere('c.name = :categoryName')
            ->setParameter('categoryName', $categoryName)
            ->orderBy('f.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return PhpFunction[] Returns an array of PhpFunction objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PhpFunction
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
