<?php

namespace App\Repository;

use App\Entity\HairdresserStandReservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HairdresserStandReservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method HairdresserStandReservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method HairdresserStandReservation[]    findAll()
 * @method HairdresserStandReservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HairdresserStandReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HairdresserStandReservation::class);
    }
}
