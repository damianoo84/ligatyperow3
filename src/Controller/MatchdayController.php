<?php

namespace App\Controller;

use App\Entity\Matchday;
use App\Form\MatchdayType;
use App\Repository\MatchdayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/matchday')]
class MatchdayController extends AbstractController
{
    #[Route('/', name: 'app_matchday_index', methods: ['GET'])]
    public function index(MatchdayRepository $matchdayRepository): Response
    {
        return $this->render('matchday/index.html.twig', [
            'matchdays' => $matchdayRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_matchday_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $matchday = new Matchday();
        $form = $this->createForm(MatchdayType::class, $matchday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($matchday);
            $entityManager->flush();

            return $this->redirectToRoute('app_matchday_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('matchday/new.html.twig', [
            'matchday' => $matchday,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_matchday_show', methods: ['GET'])]
    public function show(Matchday $matchday): Response
    {
        return $this->render('matchday/show.html.twig', [
            'matchday' => $matchday,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_matchday_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Matchday $matchday, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MatchdayType::class, $matchday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_matchday_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('matchday/edit.html.twig', [
            'matchday' => $matchday,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_matchday_delete', methods: ['POST'])]
    public function delete(Request $request, Matchday $matchday, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matchday->getId(), $request->request->get('_token'))) {
            $entityManager->remove($matchday);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_matchday_index', [], Response::HTTP_SEE_OTHER);
    }
}
