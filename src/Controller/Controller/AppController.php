<?php

namespace App\Controller\Controller;

use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{

    public function __construct(
        private readonly ItemRepository $itemRepository
    )
    {
    }

    #[Route('/news', name: 'landing')]
    public function news(): Response
    {
        $items = $this->itemRepository->getNewsItems();
        return $this->render('app/news.html.twig', [
            'items' => $items
        ]);
    }

    #[Route('/events', name: 'events')]
    public function events(): Response
    {
        $events = $this->itemRepository->getEvents();
        return $this->render('app/events.html.twig', [
            'events' => $events
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('app/contact.html.twig');
    }

}