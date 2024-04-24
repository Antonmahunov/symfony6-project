<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Symfony\Component\HttpFoundation\RequestStack;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Routing\RouterInterface;

    /**
     * @property RouterInterface $router
     * @Route("/blog")
     */
    class BlogController extends AbstractController
    {
        private RequestStack $requestStack;
        private RouterInterface $router;

        public function __construct(RequestStack $requestStack, RouterInterface $router)
        {
            $this->requestStack = $requestStack;
            $this->router = $router;
        }

        /**
         * @Route("/", name="blog_index")
         */
        public function index(): Response
        {
            $this->requestStack->getSession()->getFlashBag()->get('success');
            return $this->render('blog/index.html.twig',
                [
                    'posts' => $this->requestStack->getSession()->get('posts'),
                ]
            );

        }

        /**
         * @Route("/add", name="blog_add")
         */
        public function add(): RedirectResponse
        {
            $posts = $this->requestStack->getSession()->get('posts');
            $posts[uniqid()] = [
                'title' => 'A random title' . rand(1, 100),
                'text' => 'A random text' . rand(1, 100),
                'date' => new \DateTime(),
            ];
            $this->requestStack->getSession()->set('posts', $posts);
            $this->requestStack->getSession()->getFlashBag()->add('success', 'Post created!');

            return new RedirectResponse($this->router->generate('blog_index'));
        }

        /**
         * @Route("/show/{id}", name="blog_show")
         * @throws \Exception
         */
        public function show($id): Response
        {
            $posts = $this->requestStack->getSession()->get('posts');

            if (!$posts || !isset($posts[$id])) {
                throw new NotFoundHttpException('Post not found');
            }

            return $this->render('blog/post.html.twig', [
                'id' => $id,
                'post' => $posts[$id],
            ]);
        }
    }