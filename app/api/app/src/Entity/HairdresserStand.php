<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\HairdresserStandRepository")
 */
class HairdresserStand
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HairdresserStandReservation", mappedBy="hairdresserStand", orphanRemoval=true)
     * @ApiSubresource()
     */
    private $hairdresserStandReservations;

    public function __construct()
    {
        $this->hairdresserStandReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|HairdresserStandReservation[]
     */
    public function getHairdresserStandReservations(): Collection
    {
        return $this->hairdresserStandReservations;
    }

    public function addHairdresserStandReservation(HairdresserStandReservation $hairdresserStandReservation): self
    {
        if (!$this->hairdresserStandReservations->contains($hairdresserStandReservation)) {
            $this->hairdresserStandReservations[] = $hairdresserStandReservation;
            $hairdresserStandReservation->setHairdresserStand($this);
        }

        return $this;
    }

    public function removeHairdresserStandReservation(HairdresserStandReservation $hairdresserStandReservation): self
    {
        if ($this->hairdresserStandReservations->contains($hairdresserStandReservation)) {
            $this->hairdresserStandReservations->removeElement($hairdresserStandReservation);
            // set the owning side to null (unless already changed)
            if ($hairdresserStandReservation->getHairdresserStand() === $this) {
                $hairdresserStandReservation->setHairdresserStand(null);
            }
        }

        return $this;
    }
}
