<?php

namespace App\Repository;

use App\Entity\HomeTeamGoal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HomeTeamGoal>
 *
 * @method HomeTeamGoal|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeTeamGoal|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeTeamGoal[]    findAll()
 * @method HomeTeamGoal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomeTeamGoalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomeTeamGoal::class);
    }

    public function add(HomeTeamGoal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HomeTeamGoal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return HomeTeamGoal[] Returns an array of HomeTeamGoal objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HomeTeamGoal
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
