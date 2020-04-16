<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"post"},
 *     itemOperations={
 *     "get"={
 *      "access_control"="is_granted('VIEW', object)",
 *     }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private string $password;

    /**
     * @SerializedName("password")
     * @Assert\NotBlank()
     * @Assert\Length(min="8")
     */
    private ?string $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HairdresserStandReservation", mappedBy="user", orphanRemoval=true)
     * @ApiSubresource()
     */
    private $hairdresserStandReservations;

    public function __construct()
    {
        $this->hairdresserStandReservations = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): User
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getHairdresserStandReservations(): Collection
    {
        return $this->hairdresserStandReservations;
    }

    public function addHairdresserStandReservation(HairdresserStandReservation $hairdresserStandReservation): self
    {
        if (!$this->hairdresserStandReservations->contains($hairdresserStandReservation)) {
            $this->hairdresserStandReservations[] = $hairdresserStandReservation;
            $hairdresserStandReservation->setUser($this);
        }

        return $this;
    }

    public function removeHairdresserStandReservation(HairdresserStandReservation $hairdresserStandReservation): self
    {
        if ($this->hairdresserStandReservations->contains($hairdresserStandReservation)) {
            $this->hairdresserStandReservations->removeElement($hairdresserStandReservation);
            // set the owning side to null (unless already changed)
            if ($hairdresserStandReservation->getUser() === $this) {
                $hairdresserStandReservation->setUser(null);
            }
        }

        return $this;
    }
}
