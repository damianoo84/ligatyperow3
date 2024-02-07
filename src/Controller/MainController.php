<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\Entity\Type;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\ChangePasswordType;
use Psr\Log\LoggerInterface;
use App\Service\TypeService;
use App\Service\HistoryService;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController 
{

    #[Route('/', name: 'liga_typerow_index', methods: ['GET'])]
    #[Template('main/index.html.twig')]
    public function indexAction() : array 
    {
        return array();
    }

    #[Route('/tabela', name: 'liga_typerow_table', methods: ['GET'])]
    #[Template('main/table.html.twig')]
    public function tableAction(LoggerInterface $logger, TypeService $typeService) : array 
    {
        $logger->info('this is the table action');
        $points = $typeService->getPointsPerMatchday();
        return array('points' => $points);
    }
    
    #[Route('/wszystkietypy/{matchday}', name: 'liga_typerow_userstypes', methods: ['GET'])]
    #[Template('main/userstypes.html.twig')]
    public function userstypesAction(LoggerInterface $logger, Request $request, TypeService $typeService, UserService $userService) : array 
    {
        $logger->info('this is the userstypes action');
        $types = $typeService->getUsersTypes($request);
        $users = $userService->getActiveUsers();
        return array('types' => $types, 'users' => $users);
    }

    #[Route('/ranking', name: 'liga_typerow_ranking', methods: ['GET'])]
    #[Template('main/ranking.html.twig')]
    public function rankingAction(LoggerInterface $logger, TypeService $typeService) : array 
    {
        $logger->info('this is the ranking action');
        $ranks = $typeService->getRanking();
        return array('ranks' => $ranks);
    }

    #[Route('/historia/{season}', name: 'liga_typerow_history', methods: ['GET'])]
    #[Template('main/history.html.twig')]
    public function historyAction(LoggerInterface $logger, HistoryService $historyService, Request $request) : array 
    {
        $logger->info('this is the history action');
        $history = $historyService->getHistory($request);
        return array('points' => $history);
    }

    #[Route('/typy', name: 'liga_typerow_types', methods: ['GET','POST'])]
    #[Template('main/types.html.twig')]
    public function typesAction(Request $request, LoggerInterface $logger, TypeService $typeService) : array 
    {
        $logger->info('this is the types action');
        $types = $typeService->getUserTypes($this->getUser()->getId());

        $isTyped = false;
        if (count($types) != 0) {
            $isTyped = true;
        }

        if ($isTyped) {
            return array('types' => $types);
        }

        $meets = $typeService->getMeets();

        if ($request->getMethod() == 'POST') {
            $request->isXmlHttpRequest();
            $typeService->getMeetsPerMatchday($request, $this->getUser());
            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        return array('meets' => $meets);
    }

    #[Route('/statystyki', name: 'liga_typerow_statistics', methods: ['GET'])]
    #[Template('main/statistics.html.twig')]
    public function statisticsAction(LoggerInterface $logger) : array 
    {
        $logger->info('this is the statistics action');
        $repository = $this->getDoctrine()->getRepository(Type::class);
        $stats = $repository->getStatistics();
        
        return array('stats' => $stats);
    }

    #[Route('/zasady', name: 'liga_typerow_principles', methods: ['GET'])]
    #[Template('main/principles.html.twig')]
    public function principlesAction(LoggerInterface $logger) : array 
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
            .'ex aequo 1 miejsce i każda dostanie nagrodę w postaci zgrzewki wybranego przez siebie piwa.'
        );
        
        return array('principles' => $principles);
    }
    
    #[Route('/konto', name: 'liga_typerow_account', methods: ['GET'])]
    #[Template('main/account_settings.html.twig')]
    public function accountSettingsAction(Request $request, LoggerInterface $logger, UserPasswordEncoderInterface $passwordEncoder) : array 
    {
        $logger->info('this is the account action');

        $user  = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

//            $this->addFlash('success', "Password reset successfully");
            $this->get('session')->getFlashBag()->add('success', 'Twoje hasło zostało zmienione!');
            return $this->redirect($this->generateUrl('liga_typerow_account'));
        }

        return array(
            'user' => $user,
            'form' => $form->createView(),
        );
    }
    
}