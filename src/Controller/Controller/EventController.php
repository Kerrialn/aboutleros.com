<?php

namespace App\Controller\Controller;

use App\Entity\Event;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/events/{id}', name: 'show_event')]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig',[
            'event' => $event
        ]);
    }

}