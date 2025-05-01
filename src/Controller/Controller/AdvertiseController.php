<?php

namespace App\Controller\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdvertiseController extends AbstractController
{
    #[Route(path: '/advertise', name: 'advertise')]
    public function index(): Response
    {

        return $this->render('advertise/index.html.twig');
    }
}