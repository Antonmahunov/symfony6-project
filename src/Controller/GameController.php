<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Team;
use App\Form\GameType;
use Doctrine\ORM\EntityManagerInterface;
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
            'games' => $entityManager->getRepository(Game::class)->findAll(),
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
        $game = new Game();

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('game_show', ['id' => $game->getId()]);
        }

        return $this->render('game/create.html.twig', [
            'form' => $form->createView()
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
                ->setHomeTeamGoal($teamRepository->find($data['homeTeamGoal']))
                ->setAwayTeamGoal($teamRepository->find($data['awayTeamGoal']))
            ;

            $entityManager->flush();

            return $this->redirectToRoute('game_show', ['id' => $game->getId()]);
        }

        return $this->render('game/create.html.twig', [
            'game' => $game,
        ]);
    }
}
