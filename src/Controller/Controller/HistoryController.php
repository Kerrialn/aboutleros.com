<?php

namespace App\Controller\Controller;

use App\Repository\HistoricalEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HistoryController extends AbstractController
{
    public function __construct(
        private readonly HistoricalEventRepository $historicalEventRepository
    )
    {
    }

    #[Route(path: '/history', name: 'history')]
    public function index(): Response
    {
        $historicalEvents = $this->historicalEventRepository->findAllByDate();
       return $this->render('history/index.html.twig', [
           'historicalEvents' => $historicalEvents,
       ]);
    }
}