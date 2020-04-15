<?php

namespace App\Repository;

use App\Entity\HairdresserStand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HairdresserStand|null find($id, $lockMode = null, $lockVersion = null)
 * @method HairdresserStand|null findOneBy(array $criteria, array $orderBy = null)
 * @method HairdresserStand[]    findAll()
 * @method HairdresserStand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HairdresserStandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HairdresserStand::class);
    }
}
