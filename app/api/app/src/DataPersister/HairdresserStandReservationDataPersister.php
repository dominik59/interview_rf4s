<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\HairdresserStandReservation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class HairdresserStandReservationDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var TokenStorageInterface
     */
    private TokenStorageInterface $tokenStorage;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        EntityManagerInterface $entityManager
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof HairdresserStandReservation;
    }

    /**
     * @param HairdresserStandReservation $hairdresserStandReservation
     */
    public function persist($hairdresserStandReservation, array $context = [])
    {
        $loggedInUser = $this->tokenStorage->getToken()->getUser();
        $hairdresserStandReservation->setUser($loggedInUser);

        $this->entityManager->persist($hairdresserStandReservation);
        $this->entityManager->flush();
    }

    public function remove($hairdresserStandReservation, array $context = [])
    {
        $this->entityManager->remove($hairdresserStandReservation);
        $this->entityManager->flush();
    }
}