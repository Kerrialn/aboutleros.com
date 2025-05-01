<?php

namespace App\Controller\Controller;

use App\Entity\Feedback;
use App\Form\Form\FeedbackFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FeedbackController extends AbstractController
{
    #[Route(path: '/leros-visitor-survey', name: 'leros_visitor_survey')]
    public function feedback(Request $request): Response
    {
        $feedback = new Feedback();
        $feedbackform = $this->createForm(FeedbackFormType::class, $feedback);

        $feedbackform->handleRequest(request: $request);
        if ($feedbackform->isSubmitted() && $feedbackform->isValid()) {
            // TODO: handle submit
        }

        return $this->render('feedback/index.html.twig', [
            'feedbackForm' => $feedbackform,
        ]);
    }
}