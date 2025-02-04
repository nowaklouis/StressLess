<?php

namespace App\Repository;

use App\Entity\Favorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Favorie>
 */
class FavorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favorie::class);
    }

    //    /**
    //     * @return Favorie[] Returns an array of Favorie objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Favorie
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findFavorisIdsByUser($user): array
    {
        return $this->createQueryBuilder('f')
            ->select('IDENTITY(f.Contenu)')
            ->where('f.User = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleColumnResult();
    }

    public function findContenusFavorisByUser($user)
    {
        return $this->createQueryBuilder('f')
            ->join('f.Contenu', 'c')
            ->addSelect('c')
            ->where('f.User = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
