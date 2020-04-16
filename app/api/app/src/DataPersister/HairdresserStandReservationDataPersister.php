<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\HairdresserStandReservation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class HairdresserStandReservationDataPersister implements DataPersisterInterface
{
    private TokenStorageInterface $tokenStorage;
    private EntityManagerInterface $entityManager;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        EntityManagerInterface $entityManager
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
    }

    public function supports($object): bool
    {
        return $object instanceof HairdresserStandReservation;
    }

    public function persist($hairdresserStandReservation)
    {
        $loggedInUser = $this->tokenStorage->getToken()->getUser();
        $hairdresserStandReservation->setUser($loggedInUser);

        $this->entityManager->persist($hairdresserStandReservation);
        $this->entityManager->flush();
    }

    public function remove($hairdresserStandReservation)
    {
        $this->entityManager->remove($hairdresserStandReservation);
        $this->entityManager->flush();
    }
}