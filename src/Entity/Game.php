<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[Assert\NotIdenticalTo(propertyPath: 'awayTeam', message: 'The home team and away team must not be identical.')]
    private ?Team $homeTeam = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotIdenticalTo(propertyPath: 'homeTeam', message: 'The home team and away team must not be identical.')]
    private ?Team $awayTeam = null;

    #[ORM\Column]
    private ?int $homeTeamGoal = null;

    #[ORM\Column]
    private ?int $awayTeamGoal = null;

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
        return $this->homeTeamGoal;
    }

    public function setHomeTeamGoal(int $homeTeamGoal): self
    {
        $this->homeTeamGoal = $homeTeamGoal;

        return $this;
    }

    public function getAwayTeamGoal(): ?int
    {
        return $this->awayTeamGoal;
    }

    public function setAwayTeamGoal(int $awayTeamGoal): self
    {
        $this->awayTeamGoal = $awayTeamGoal;

        return $this;
    }
}
