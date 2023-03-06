<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Team;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_team')]
    public function index(): Response
    {
        return $this->render('team/index.html.twig', [
            'teams' => $this->entityManager->getRepository(Team::class)->findAll()
        ]);
    }

    #[Route('/team/history/{id}', name: 'team_history')]
    public function teamHistory(Team $team): Response
    {
        return $this->render('team/history.html.twig', [
            'games' => $this->entityManager->getRepository(Game::class)->findGamesByTeam($team)
        ]);
    }
}
