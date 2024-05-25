<?php

namespace App\Controller;

use App\Entity\Micropost;
use App\Form\MicropostType;
use App\Repository\MicropostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/micro-post")
 */
class MicropostController extends AbstractController
{

    private FormFactoryInterface $formFactory;
    private RequestStack $requestStack;
    private $micropostRepository;

    public function __construct(
        FormFactoryInterface   $formFactory,
        RequestStack $requestStack,
        MicropostRepository $micropostRepository
    )
    {
        $this->formFactory = $formFactory;
        $this->requestStack = $requestStack;
        $this->micropostRepository = $micropostRepository;
    }

    /**
     * @Route("/", name="micro_post_index")
     */
    public function index(): Response
    {
        return $this->render('micro-post/index.html.twig', [
           'posts' =>  $this->micropostRepository->findBy([], ['time' => 'DESC']),
        ]);
    }

    /**
     * @Route("/add", name="micropost_add")
     */
    public function add(Request $request): Response
    {
        $micropost = new Micropost();
        $micropost->setTime(new \DateTime());

        $form = $this->formFactory->create(MicropostType::class, $micropost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $this->entityManager->persist($micropost);
                $this->entityManager->flush();

                return $this->redirectToRoute('micro_post_index');
            }

        return $this->render('micro-post/add.html.twig', [
            'form' => $form->createView(),
        ]);

    }
//
    /**
     * @Route("/{id}", name="micropost_show")
     */
    public function show(Micropost $micropost): Response
    {
        return $this->render('micro-post/show.html.twig', [
            'post' => $this->micropostRepository->find($micropost),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="micropost_edit")
     */
    public function edit(Request $request, Micropost $micropost): Response
    {
        $form = $this->formFactory->create(MicropostType::class, $micropost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render('micro-post/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="micropost_delete")
     */
    public function delete(Request $request, Micropost $micropost): Response
    {

        $micropostId = $micropost->getId();
        $this->entityManager->remove($micropost);
        $this->entityManager->flush();

        $this->requestStack->getSession()->getFlashbag()->add(
            'notice',
            'Post ' . $micropostId . ' has been successfully deleted.'
        );

        return $this->redirectToRoute('micro_post_index');
    }

}