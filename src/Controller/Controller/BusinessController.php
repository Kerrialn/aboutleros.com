<?php

namespace App\Controller\Controller;

use App\Entity\Business;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\HistoricalEventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

class BusinessController extends AbstractController
{
    #[Route('/show/{slug:business}', name: 'show_business')]
    public function show(Business $business): Response
    {
        return $this->render('business/show.html.twig', [
            'business' => $business
        ]);
    }

}