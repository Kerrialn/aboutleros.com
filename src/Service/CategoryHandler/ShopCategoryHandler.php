<?php

namespace App\Service\CategoryHandler;

use App\DataTransferObject\ItemDto;
use App\Entity\Category;
use App\Enum\ContentTypeEnum;
use App\Repository\BusinessRepository;
use App\Service\CategoryHandler\Contract\CategoryHandlerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AutoconfigureTag('app.category_handler')]
final class ShopCategoryHandler implements CategoryHandlerInterface
{
    public function __construct(
        private BusinessRepository    $businessRepository,
        private UrlGeneratorInterface $urlGenerator,
    )
    {
    }

    public function supports(Category $category): bool
    {
        return $category->getContentTypeEnum() === ContentTypeEnum::SHOPS;
    }

    public function fetchItems(Category $category): array
    {
        $businesses = $this->businessRepository->findAll();

        return array_map(
            fn($biz) => new ItemDto(
                $biz->getTitle(),
                $biz->getMainImage(),
                $this->urlGenerator->generate(
                    'show_business',
                    ['slug' => $biz->getSlug()]
                )
            ),
            $businesses
        );
    }

    public function getTemplate() : string
    {
        return 'discover/shops.html.twig';
    }

    public function getTemplateParameters(Category $category): array
    {
        $items   = $this->fetchItems($category);

        return [
            'category' => $category,
            'items'    => $items,
        ];
    }
}
