<?php

namespace App\Controller;

use App\Repository\MicropostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route("/micro-post")
 */
class MicropostController extends AbstractController
{
    public function __construct(
        MicropostRepository $micropostRepository,
        Environment $environment)
    {
        $this->micropostRepository = $micropostRepository;
    }

    /**
     * @Route("/", name="micro_post_index")
     */
    public function index()
    {
        return $this->render('micro-post/index.html.twig', [
           'posts' =>  $this->micropostRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="micropost_add")
     */
    public function add(): Response
    {
        return $this->render('micro-post/add.html.twig');

    }
}