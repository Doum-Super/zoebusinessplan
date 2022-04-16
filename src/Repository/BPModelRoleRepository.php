<?php

namespace App\Repository;

use App\Entity\BPModelRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BPModelRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method BPModelRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method BPModelRole[]    findAll()
 * @method BPModelRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BPModelRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BPModelRole::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(BPModelRole $entity, bool $flush = true): void
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
    public function remove(BPModelRole $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findBpModelByCustomer($id)
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.bpModel', 'bp')
            ->leftJoin('b.role', 'role')
            ->where('bp.id = :id')
            ->andWhere('role.code = :role')
            ->setParameter('id', $id)
            ->setParameter('role', 'ROLE_CUSTOMER')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
