<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberOfPoints = null;

    #[ORM\Column]
    private ?int $hostType = null;

    #[ORM\Column]
    private ?int $guestType = null;

    #[ORM\ManyToOne(inversedBy: 'types')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'types')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Meet $meet = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfPoints(): ?int
    {
        return $this->numberOfPoints;
    }

    public function setNumberOfPoints(?int $numberOfPoints): static
    {
        $this->numberOfPoints = $numberOfPoints;

        return $this;
    }

    public function getHostType(): ?int
    {
        return $this->hostType;
    }

    public function setHostType(int $hostType): static
    {
        $this->hostType = $hostType;

        return $this;
    }

    public function getGuestType(): ?int
    {
        return $this->guestType;
    }

    public function setGuestType(int $guestType): static
    {
        $this->guestType = $guestType;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getMeet(): ?Meet
    {
        return $this->meet;
    }

    public function setMeet(?Meet $meet): static
    {
        $this->meet = $meet;

        return $this;
    }

    public function getCreated(): ?\DateTimeImmutable
    {
        return $this->created;
    }

    public function setCreated(\DateTimeImmutable $created): static
    {
        $this->created = $created;

        return $this;
    }

    public function getUpdated(): ?\DateTimeImmutable
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeImmutable $updated): static
    {
        $this->updated = $updated;

        return $this;
    }

}
