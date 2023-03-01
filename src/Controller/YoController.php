<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YoController extends AbstractController
{
    #[Route('/', name: 'app_yo')]
    public function index(): Response
    {
        return $this->render('yo/index.html.twig', [
            'controller_name' => 'YoController',
        ]);
    }

    #[Route('/asd', name: 'ee')]
    public function qwe(): Response
    {
        return new Response('YOYOYO');
    }
}
