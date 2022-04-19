<?php

namespace App\Repository;

use App\Entity\BPModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BPModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method BPModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method BPModel[]    findAll()
 * @method BPModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BPModelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BPModel::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(BPModel $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(BPModel $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return BPModel[] Returns an array of BPModel objects
     */
    public function findMySubscriptionBp($user)
    {
        return $this->createQueryBuilder('b')
            //->andWhere('b.exampleField = :val')
            ->leftJoin('b.customerBPs', 'cb', Join::WITH, 'cb.createdBy = :createdBy')
            ->setParameter('createdBy', $user)
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
