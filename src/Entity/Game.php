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

    #[ORM\Column]
    private ?int $HomeTeamGoal = null;

    #[ORM\Column]
    private ?int $AwayTeamGoal = null;

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

    public function getHomeTeamGoal(): ?int
    {
        return $this->HomeTeamGoal;
    }

    public function setHomeTeamGoal(int $HomeTeamGoal): self
    {
        $this->HomeTeamGoal = $HomeTeamGoal;

        return $this;
    }

    public function getAwayTeamGoal(): ?int
    {
        return $this->AwayTeamGoal;
    }

    public function setAwayTeamGoal(int $AwayTeamGoal): self
    {
        $this->AwayTeamGoal = $AwayTeamGoal;

        return $this;
    }
}
