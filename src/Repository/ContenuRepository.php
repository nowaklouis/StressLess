<?php

namespace App\Repository;

use App\Entity\Contenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contenu>
 */
class ContenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contenu::class);
    }

    //    /**
    //     * @return Contenu[] Returns an array of Contenu objects
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

    //    public function findOneBySomeField($value): ?Contenu
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function searchAndOrder(?string $search = '', string $order = 'asc')
    {
        $qb = $this->createQueryBuilder('c');

        if (!empty($search)) {
            $qb->andWhere('c.Title LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        $qb->orderBy('c.Title', $order === 'asc' ? 'ASC' : 'DESC');

        return $qb->getQuery();
    }
}
