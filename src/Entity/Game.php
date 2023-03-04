<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private int $matchLeagueId;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $homeTeam = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $awayTeam = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getMatchLeagueId(): int
    {
        return $this->matchLeagueId;
    }

    public function setMatchLeagueId(int $matchLeagueId): self
    {
        $this->matchLeagueId = $matchLeagueId;

        return $this;
    }

    public function getHomeTeam(): ?Team
    {
        return $this->homeTeam;
    }

    public function setHomeTeam(?Team $homeTeam): self
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    public function getAwayTeam(): ?Team
    {
        return $this->awayTeam;
    }

    public function setAwayTeam(?Team $awayTeam): self
    {
        $this->awayTeam = $awayTeam;

        return $this;
    }
}
