<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/{name}", name="blog_index")
     */
    public function index(): Response
    {

        return $this->render('blog/index.html.twig',
            [
                'post' => $this->requestStack->getSession()->get('post'),
            ]
        );
    }

    /**
     * @Route("/add", name="blog_add")
     */
    public function add(): void
    {
        $posts = $this->requestStack->getSession()->get('posts');
        $posts[uniqid()] = [
            'title' => 'A random title' . rand(1, 100),
            'text' => 'A random text' . rand(1, 100),
        ];

        $this->requestStack->getSession()->set('posts', $posts);
    }

    /**
     * @Route("/show/{id}", name="blog_show")
     */
    public function show($id): Response
    {
        $posts = $this->requestStack->getSession()->get('posts');

        if (!$posts || !isset($posts[$id])) {
            throw new NotFoundHttpException('Post not found');
        }

        return $this->render('blog/show.html.twig', [
            'id' => $id,
            'post' => $posts[$id],
        ]);
    }
}