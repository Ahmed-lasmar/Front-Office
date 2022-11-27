<?php

namespace App\Repository;

use App\Entity\Conge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Conge|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conge|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conge[]    findAll()
 * @method Conge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conge::class);
    }

    /**
     * @return Conge[] Returns an array of Conge objects
     */

    public function findByCongeByPer($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.idper = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Conge
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}