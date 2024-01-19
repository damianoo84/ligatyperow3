<?php

namespace App\Entity;

use App\Repository\StatisticRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatisticRepository::class)]
class Statistic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $match2 = null;

    #[ORM\Column]
    private ?int $match4 = null;

    #[ORM\Column]
    private ?int $totalPoints = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\Column]
    private ?int $numOfQue = null;

    #[ORM\ManyToOne(inversedBy: 'statistics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'statistics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Season $season = null;

    #[ORM\OneToMany(mappedBy: 'statistic', targetEntity: History::class)]
    private Collection $histories;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated = null;

    public function __construct()
    {
        $this->histories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatch2(): ?int
    {
        return $this->match2;
    }

    public function setMatch2(int $match2): static
    {
        $this->match2 = $match2;

        return $this;
    }

    public function getMatch4(): ?int
    {
        return $this->match4;
    }

    public function setMatch4(int $match4): static
    {
        $this->match4 = $match4;

        return $this;
    }

    public function getTotalPoints(): ?int
    {
        return $this->totalPoints;
    }

    public function setTotalPoints(int $totalPoints): static
    {
        $this->totalPoints = $totalPoints;

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

    public function getNumOfQue(): ?int
    {
        return $this->numOfQue;
    }

    public function setNumOfQue(int $numOfQue): static
    {
        $this->numOfQue = $numOfQue;

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

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): static
    {
        $this->season = $season;

        return $this;
    }

    /**
     * @return Collection<int, History>
     */
    public function getHistories(): Collection
    {
        return $this->histories;
    }

    public function addHistory(History $history): static
    {
        if (!$this->histories->contains($history)) {
            $this->histories->add($history);
            $history->setStatistic($this);
        }

        return $this;
    }

    public function removeHistory(History $history): static
    {
        if ($this->histories->removeElement($history)) {
            // set the owning side to null (unless already changed)
            if ($history->getStatistic() === $this) {
                $history->setStatistic(null);
            }
        }

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
