<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Type;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\ChangePasswordType;
use Psr\Log\LoggerInterface;
use App\Service\TypeService;
use App\Service\HistoryService;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MainController extends AbstractController 
{

    private EntityManagerInterface $entityManager;

    // Wstrzyknięcie EntityManagerInterface w konstruktorze
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/', name: 'liga_typerow_index', methods: ['GET'])]
    public function indexAction() : \Symfony\Component\HttpFoundation\RedirectResponse 
    {
        return new RedirectResponse('/tabela'); 
    }

    #[Route('/tabela', name: 'liga_typerow_table', methods: ['GET'])]
    public function tableAction(LoggerInterface $logger, TypeService $typeService) : Response 
    {
        $logger->info('this is the table action');
        $points = $typeService->getPointsPerMatchday();
                
        return $this->render('main/table.html.twig', [
            'points' => $points,
        ]);
    }
    
    #[Route('/wszystkietypy/{matchday}', name: 'liga_typerow_userstypes', methods: ['GET'])]
    public function userstypesAction(LoggerInterface $logger, Request $request, TypeService $typeService, UserService $userService) : Response 
    {
        $logger->info('this is the userstypes action');
        $types = $typeService->getUsersTypes($request);
        $users = $userService->getActiveUsers();
        
        return $this->render('main/userstypes.html.twig', [
            'types' => $types,
            'users' => $users
        ]);
    }

    #[Route('/ranking', name: 'liga_typerow_ranking', methods: ['GET'])]
    public function rankingAction(LoggerInterface $logger, TypeService $typeService) : Response 
    {
        $logger->info('this is the ranking action');
        $ranks = $typeService->getRanking();

        return $this->render('main/ranking.html.twig', [
            'ranks' => $ranks,
        ]);
    }

    #[Route('/historia/{season}', name: 'liga_typerow_history', methods: ['GET'])]
    public function historyAction(LoggerInterface $logger, HistoryService $historyService, Request $request) : Response 
    {
        $logger->info('this is the history action');
        $history = $historyService->getHistory($request);
        
        return $this->render('main/history.html.twig', [
            'points' => $history,
        ]);
    }

    #[Route('/typy', name: 'liga_typerow_types', methods: ['GET','POST'])]
    public function typesAction(Request $request, LoggerInterface $logger, TypeService $typeService) : Response 
    {
        $logger->info('this is the types action');
        $types = $typeService->getUserTypes($this->getUser()->getId());

        $isTyped = false;
        if (count($types) != 0) {
            $isTyped = true;
        }

        if ($isTyped) {
            return $this->render('main/types.html.twig', [
                'types' => $types,
            ]);
        }

        $meets = $typeService->getMeets();

        if ($request->getMethod() == 'POST') {
            $request->isXmlHttpRequest();
            $typeService->getMeetsPerMatchday($request, $this->getUser());
            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        return $this->render('main/types.html.twig', [
            'meets' => $meets,
        ]);
    }

    #[Route('/statystyki', name: 'liga_typerow_statistics', methods: ['GET'])]
    public function statisticsAction(LoggerInterface $logger) : Response 
    {
        $logger->info('this is the statistics action');
        $repository = $this->getDoctrine()->getRepository(Type::class);
        $stats = $repository->getStatistics();
        
        return $this->render('main/statistics.html.twig', [
            'stats' => $stats,
        ]);
    }

    #[Route('/zasady', name: 'liga_typerow_principles', methods: ['GET'])]
    public function principlesAction(LoggerInterface $logger) : Response 
    {
        $logger->info('this is the principles action');
        $principles = array(
            'Liga trwa 15 kolejnych tygodni.', 'W każdym tygodniu typujemy 10 wybranych meczy, które odbędą się w tygodniu następnym. '
            , 'Czas na typy to 7 dni liczony od poniedziałku '
            . 'godz.00:00 do niedzieli godz. 23:59',
            'Za prawidłowe wytypowanie rozstrzygnięcia meczu otrzymuje się 2 pkt. '
            . 'Za prawidłowe wytypowanie wyniku bramkowego otrzymuje się 4 pkt.',
            'Jeżeli w meczu dojdzie do dogrywki lub rzutów karnych to liczy się '
            . 'wynik meczu regulaminowych 90 minut.',
            'Jeżeli mecz niezostanie rozegrany w danej kolejce lub przerwany (i nie dokończony) '
            . 'lub zostanie uznany jako walkower, albo ja pomylę się (podam spotkanie nie z tej kolejki, '
            . 'zdubluję spotkanie lub podam złego gospodarza meczu) wtedy typy na ten mecz zostają anulowane. ',
            'Jeżeli zwycięzcą po 15 kolejkach okażą się dwie lub więcej osób, '
            . 'które będą miały taką samą ilość punktów to nie robimy dogrywki, każda z tych osób zajmie '
            .'ex aequo 1 miejsce i każda dostanie nagrodę w postaci czteropaku wybranego przez siebie piwa.'
        );
        
        return $this->render('main/principles.html.twig', [
            'principles' => $principles,
        ]);
    }
    
    #[Route('/konto', name: 'liga_typerow_account', methods: ['GET','POST'])]
    public function accountSetAction(Request $request, LoggerInterface $logger, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, SessionInterface $session) : Response 
    {
        $logger->info('this is the account action');

        $user  = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//        if ($request->getMethod() == 'POST') {

            // encode the plain password
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

//            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

//            $this->addFlash('success', "Password reset successfully");
            $session->getFlashBag()->add('success', 'Twoje hasło zostało zmienione!');
            return $this->redirect($this->generateUrl('liga_typerow_account'));
        }

        return $this->render('main/account_settings.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
    
}