<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Validator\Constraint as CustomAssert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get","post"},
 *     itemOperations={"get"},
 *     normalizationContext={"groups"={"layout:read"}},
 *     denormalizationContext={"groups"={"layout:write"}},
 * )
 * @ORM\Entity(repositoryClass="App\Repository\HairdresserStandReservationRepository")
 */
class HairdresserStandReservation
{
    /**
     * @ORM\Column(type="time")
     * @Groups({"layout:read", "layout:write"})
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "type"="string",
     *             "example"="00:00"
     *         }
     *     }
     * )
     * @CustomAssert\OnlyFullOrHalfHour()
     * @CustomAssert\HourWithinOpeningHours()
     * @Assert\NotBlank()
     */
    public $start_hour;

    /**
     * @ORM\Column(type="time")
     * @Groups({"layout:read", "layout:write"})
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "type"="string",
     *             "example"="00:00"
     *         }
     *     }
     * )
     * @CustomAssert\OnlyFullOrHalfHour()
     * @CustomAssert\HourWithinOpeningHours()
     * @Assert\GreaterThan(propertyPath="start_hour")
     * @Assert\NotBlank()
     */
    public $end_hour;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @Groups({"layout:read", "layout:write"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HairdresserStand", inversedBy="hairdresserStandReservations")
     * @Groups({"layout:read", "layout:write"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $hairdresserStand;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="hairdresserStandReservations")
     * @Groups({"layout:read"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     * @Groups({"layout:read", "layout:write"})
     * @ApiProperty(
     *     attributes={
     *         "openapi_context"={
     *             "type"="string",
     *             "example"="01-01-2020"
     *         }
     *     }
     * )
     * @Assert\NotBlank()
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHairdresserStand(): ?HairdresserStand
    {
        return $this->hairdresserStand;
    }

    public function setHairdresserStand(?HairdresserStand $hairdresserStand): self
    {
        $this->hairdresserStand = $hairdresserStand;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStartHour(): ?\DateTimeInterface
    {
        return $this->start_hour;
    }

    public function setStartHour(\DateTimeInterface $start_hour): self
    {
        $this->start_hour = $start_hour;

        return $this;
    }

    public function getEndHour(): ?\DateTimeInterface
    {
        return $this->end_hour;
    }

    public function setEndHour(\DateTimeInterface $end_hour): self
    {
        $this->end_hour = $end_hour;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
