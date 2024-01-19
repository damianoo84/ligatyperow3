<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Type::class)]
    private Collection $types;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Statistic::class)]
    private Collection $statistics;

    #[ORM\Column(length: 9)]
    private ?string $phone = null;

    #[ORM\Column]
    private ?int $numberOfWins = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\Column]
    private ?int $priority = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastActivityAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $rankingPosition = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxPointsPerQueue = null;

    #[ORM\Column(nullable: true)]
    private ?int $minPointsPerQueue = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $nick = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $favoritePolandTeam = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $favoriteForeignTeam = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberOfFirstPlaces = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberOfSecondPlaces = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberOfThirdPlaces = null;

    #[ORM\Column(nullable: true)]
    private ?int $lastWinner = null;

    #[ORM\Column(nullable: true)]
    private ?int $liderOfRanking = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated = null;

    #[ORM\Column(length: 20)]
    private ?string $shortname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->types = new ArrayCollection();
        $this->statistics = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

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
            $type->setUser($this);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getUser() === $this) {
                $type->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Statistic>
     */
    public function getStatistics(): Collection
    {
        return $this->statistics;
    }

    public function addStatistic(Statistic $statistic): static
    {
        if (!$this->statistics->contains($statistic)) {
            $this->statistics->add($statistic);
            $statistic->setUser($this);
        }

        return $this;
    }

    public function removeStatistic(Statistic $statistic): static
    {
        if ($this->statistics->removeElement($statistic)) {
            // set the owning side to null (unless already changed)
            if ($statistic->getUser() === $this) {
                $statistic->setUser(null);
            }
        }

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getNumberOfWins(): ?int
    {
        return $this->numberOfWins;
    }

    public function setNumberOfWins(int $numberOfWins): static
    {
        $this->numberOfWins = $numberOfWins;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getLastActivityAt(): ?\DateTimeInterface
    {
        return $this->lastActivityAt;
    }

    public function setLastActivityAt(?\DateTimeInterface $lastActivityAt): static
    {
        $this->lastActivityAt = $lastActivityAt;

        return $this;
    }

    public function getRankingPosition(): ?int
    {
        return $this->rankingPosition;
    }

    public function setRankingPosition(?int $rankingPosition): static
    {
        $this->rankingPosition = $rankingPosition;

        return $this;
    }

    public function getMaxPointsPerQueue(): ?int
    {
        return $this->maxPointsPerQueue;
    }

    public function setMaxPointsPerQueue(?int $maxPointsPerQueue): static
    {
        $this->maxPointsPerQueue = $maxPointsPerQueue;

        return $this;
    }

    public function getMinPointsPerQueue(): ?int
    {
        return $this->minPointsPerQueue;
    }

    public function setMinPointsPerQueue(?int $minPointsPerQueue): static
    {
        $this->minPointsPerQueue = $minPointsPerQueue;

        return $this;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(?string $nick): static
    {
        $this->nick = $nick;

        return $this;
    }

    public function getFavoritePolandTeam(): ?string
    {
        return $this->favoritePolandTeam;
    }

    public function setFavoritePolandTeam(?string $favoritePolandTeam): static
    {
        $this->favoritePolandTeam = $favoritePolandTeam;

        return $this;
    }

    public function getFavoriteForeignTeam(): ?string
    {
        return $this->favoriteForeignTeam;
    }

    public function setFavoriteForeignTeam(?string $favoriteForeignTeam): static
    {
        $this->favoriteForeignTeam = $favoriteForeignTeam;

        return $this;
    }

    public function getNumberOfFirstPlaces(): ?int
    {
        return $this->numberOfFirstPlaces;
    }

    public function setNumberOfFirstPlaces(?int $numberOfFirstPlaces): static
    {
        $this->numberOfFirstPlaces = $numberOfFirstPlaces;

        return $this;
    }

    public function getNumberOfSecondPlaces(): ?int
    {
        return $this->numberOfSecondPlaces;
    }

    public function setNumberOfSecondPlaces(?int $numberOfSecondPlaces): static
    {
        $this->numberOfSecondPlaces = $numberOfSecondPlaces;

        return $this;
    }

    public function getNumberOfThirdPlaces(): ?int
    {
        return $this->numberOfThirdPlaces;
    }

    public function setNumberOfThirdPlaces(?int $numberOfThirdPlaces): static
    {
        $this->numberOfThirdPlaces = $numberOfThirdPlaces;

        return $this;
    }

    public function getLastWinner(): ?int
    {
        return $this->lastWinner;
    }

    public function setLastWinner(?int $lastWinner): static
    {
        $this->lastWinner = $lastWinner;

        return $this;
    }

    public function getLiderOfRanking(): ?int
    {
        return $this->liderOfRanking;
    }

    public function setLiderOfRanking(?int $liderOfRanking): static
    {
        $this->liderOfRanking = $liderOfRanking;

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

    public function getShortname(): ?string
    {
        return $this->shortname;
    }

    public function setShortname(string $shortname): static
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}
