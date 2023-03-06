<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/game', name: 'game_index', methods: 'GET')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }

    #[Route('/game/{id}', name: 'game_show', methods: 'GET', requirements: ['id' => '\d+'])]
    public function show(Game $game): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/game/create', name: 'game_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = null;

        if ($request->isMethod('POST')) {
            // должна быть конечно же валидация
            $data = $request->request->all();

            $teamRepository = $entityManager->getRepository(Team::class);

            $game = (new Game())
                ->setMatchLeagueId($data['matchLeagueId'])
                ->setHomeTeam($teamRepository->find($data['homeTeam']))
                ->setAwayTeam($teamRepository->find($data['awayTeam']))
            ;

            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('game_show', ['id' => $game->getId()]);
        }

        return $this->render('game/create.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/game/edit/{id}', name: 'game_update', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, Game $game): Response
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();

            $teamRepository = $entityManager->getRepository(Team::class);

            $game->setMatchLeagueId($data['matchLeagueId'])
                ->setHomeTeam($teamRepository->find($data['homeTeam']))
                ->setAwayTeam($teamRepository->find($data['awayTeam']))
            ;

            $entityManager->flush();

            return $this->redirectToRoute('game_show', ['id' => $game->getId()]);
        }

        return $this->render('game/create.html.twig', [
            'game' => $game,
        ]);
    }
}
