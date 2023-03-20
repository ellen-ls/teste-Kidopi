<?php

namespace App\Repository;

use App\Entity\SalveInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SalveInfo>
 *
 * @method SalveInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method SalveInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method SalveInfo[]    findAll()
 * @method SalveInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalveInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SalveInfo::class);
    }

    public function save(SalveInfo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SalveInfo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}
