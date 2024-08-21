<?php

namespace App\Controller;

use App\Entity\Meet;
use App\Form\MeetType;
use App\Repository\MeetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin-panel/meet')]
class MeetController extends AbstractController
{
    #[Route('/', name: 'app_meet_index', methods: ['GET'])]
    public function index(MeetRepository $meetRepository): Response
    {
        return $this->render('meet/index.html.twig', [
            'meets' => $meetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_meet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $meet = new Meet();
        $form = $this->createForm(MeetType::class, $meet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($meet);
            $entityManager->flush();

            return $this->redirectToRoute('app_meet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('meet/new.html.twig', [
            'meet' => $meet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_meet_show', methods: ['GET'])]
    public function show(Meet $meet): Response
    {
        return $this->render('meet/show.html.twig', [
            'meet' => $meet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_meet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Meet $meet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MeetType::class, $meet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_meet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('meet/edit.html.twig', [
            'meet' => $meet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_meet_delete', methods: ['POST'])]
    public function delete(Request $request, Meet $meet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$meet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($meet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_meet_index', [], Response::HTTP_SEE_OTHER);
    }
}
