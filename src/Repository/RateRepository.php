<?php

namespace App\Repository;

use App\Entity\Rate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rate>
 *
 * @method Rate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rate[]    findAll()
 * @method Rate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rate::class);
    }

    public function add(Rate $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Rate $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Rate[] Returns an array of Rate objects
     */
    public function topRatedOffer(): array
    {
       return $this->createQueryBuilder('r')
           ->select('count(r) AS total')
           ->addSelect('r.offreemploi AS offer')
           ->where('r.rating = like')
           //->from('APP\Entity\Rate')
           ->groupBy('offer')
           ->orderBy('total', 'ASC')
           ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }


    public function topRatedOfferr()
    {
        $entitymMnager=$this->getEntityManager();
        $querry=$entitymMnager->createQuery("SELECT s.offreemploi, count(s) AS total FROM APP\Entity\Rate s WHERE s.rating='like' GROUP BY s.offreemploi ORDER BY total ASC")
            ->getResult()
        ;
        return $querry;
    }

//    public function findOneBySomeField($value): ?Rate
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
