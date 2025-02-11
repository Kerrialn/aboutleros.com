<?php

namespace App\Controller\Controller;

use App\Entity\Artefact;
use App\Repository\ArtefactRepository;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

class ArtefactController extends AbstractController
{
    public function __construct(
        private readonly ArtefactRepository $artefactRepository
    )
    {
    }
    #[Route('/', name: 'landing')]
    public function landing(#[MapQueryParameter] null|string $category = null): Response
    {
        $artefact = $this->artefactRepository->findOneBy(['slug' => $category]);
        $artefacts = $this->artefactRepository->getMainCategories();

        return $this->render('artefact/index.html.twig', [
            'artefacts' => $artefacts,
            'artefact'=> $artefact
        ]);
    }

    #[Route('/show/{slug:artefact}', name: 'show_artefact')]
    public function show(Artefact $artefact): Response
    {
        return $this->render('artefact/show.html.twig', [
            'artefact'=> $artefact
        ]);
    }

}