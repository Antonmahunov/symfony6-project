<?php

namespace App\Repository;

use App\Entity\Micropost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Micropost>
 *
 * @method Micropost|null find($id, $lockMode = null, $lockVersion = null)
 * @method Micropost|null findOneBy(array $criteria, array $orderBy = null)
 * @method Micropost[]    findAll()
 * @method Micropost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MicropostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Micropost::class);
    }

    public function getPaginatedPosts(int $page, int $limit): Paginator
    {
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.time', 'DESC')
            ->getQuery();

        $paginator = new Paginator($query, $fetchJoinCollection = true);
        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        return $paginator;
    }

//    /**
//     * @return Micropost[] Returns an array of Micropost objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Micropost
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
