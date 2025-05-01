<?php

namespace App\Controller\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Service\CategoryHandler\Contract\CategoryHandlerInterface;
use ECSPrefix202306\Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DiscoverController extends AbstractController
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        #[TaggedIterator('app.category_handler')]
        /** @var CategoryHandlerInterface[] */
        private iterable $handlers
    )
    {
    }

    #[Route('/discover', name: 'discover')]
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        $mainCategories = $this->categoryRepository->getMainCategories();
        return $this->render('discover/index.html.twig', [
            'categories' => $mainCategories,
        ]);
    }

    #[Route('/discover/{category}', name: 'discover_item')]
    public function show(#[MapEntity(mapping: [
        'category' => 'slug',
    ])] Category $category): \Symfony\Component\HttpFoundation\Response
    {
        /**
         * @var CategoryHandlerInterface $handler
         */
        foreach ($this->handlers as $handler) {

            if (! $handler->supports($category)) {
                continue;
            }

            return $this->render(
                view: $handler->getTemplate(),
                parameters: $handler->getTemplateParameters($category)
            );
        }

        throw $this->createNotFoundException("No handler for {$category->getSlug()}");
    }
}