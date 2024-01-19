<?php

namespace App\Entity;

use App\Repository\MeetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeetRepository::class)]
class Meet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $hostGoals = null;

    #[ORM\Column(nullable: true)]
    private ?int $guestGoals = null;

    #[ORM\Column(length: 255)]
    private ?string $term = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'meets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?League $league = null;

    #[ORM\ManyToOne(inversedBy: 'meets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matchday $matchday = null;

    #[ORM\OneToMany(mappedBy: 'meet', targetEntity: Type::class)]
    private Collection $types;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $hostTeam = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $guestTeam = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated = null;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getHostGoals(): ?int
    {
        return $this->hostGoals;
    }

    public function setHostGoals(?int $hostGoals): static
    {
        $this->hostGoals = $hostGoals;

        return $this;
    }

    public function getGuestGoals(): ?int
    {
        return $this->guestGoals;
    }

    public function setGuestGoals(?int $guestGoals): static
    {
        $this->guestGoals = $guestGoals;

        return $this;
    }

    public function getTerm(): ?string
    {
        return $this->term;
    }

    public function setTerm(string $term): static
    {
        $this->term = $term;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): static
    {
        $this->league = $league;

        return $this;
    }

    public function getMatchday(): ?Matchday
    {
        return $this->matchday;
    }

    public function setMatchday(?Matchday $matchday): static
    {
        $this->matchday = $matchday;

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            $type->setMeet($this);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getMeet() === $this) {
                $type->setMeet(null);
            }
        }

        return $this;
    }

    public function getHostTeam(): ?Team
    {
        return $this->hostTeam;
    }

    public function setHostTeam(?Team $hostTeam): static
    {
        $this->hostTeam = $hostTeam;

        return $this;
    }

    public function getGuestTeam(): ?Team
    {
        return $this->guestTeam;
    }

    public function setGuestTeam(?Team $guestTeam): static
    {
        $this->guestTeam = $guestTeam;

        return $this;
    }

    public function getCreated(): ?\DateTimeImmutable
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeImmutable $created): static
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
