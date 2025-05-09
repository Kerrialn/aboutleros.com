<?php

namespace App\Service\CategoryHandler;

use App\DataTransferObject\ItemDto;
use App\Entity\Category;
use App\Enum\ContentTypeEnum;
use App\Repository\EventRepository;
use App\Service\CategoryHandler\Contract\CategoryHandlerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AutoconfigureTag('app.category_handler')]
final class EventCategoryHandler implements CategoryHandlerInterface
{
    public function __construct(
        private EventRepository $eventRepository,
        private UrlGeneratorInterface $urlGenerator,
    )
    {
    }

    public function supports(Category $category): bool
    {
        return $category->getContentTypeEnum() === ContentTypeEnum::EVENTS;
    }

    public function fetchItems(Category $category): array
    {
        return array_map(
            fn($event): \App\DataTransferObject\ItemDto => new ItemDto(
                title: $event->getTitle(),
                image: null,
                route: $this->urlGenerator->generate(
                    'show_event',
                    [
                        'id' => $event->getId(),
                    ]
                )
            ),
            $this->eventRepository->findStartingSoon()
        );
    }

    public function getTemplate(): string
    {
        return 'discover/events.html.twig';
    }

    public function getTemplateParameters(Category $category): array
    {
        $items = $this->fetchItems($category);

        return [
            'category' => $category,
            'items' => $items,
        ];
    }
}
