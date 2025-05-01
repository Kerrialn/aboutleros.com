<?php

namespace App\Service\CategoryHandler\Contract;

use App\DataTransferObject\ItemDto;
use App\Entity\Category;

interface CategoryHandlerInterface
{
    public function supports(Category $category): bool;

    /**
     * @return ItemDto[]
     */
    public function fetchItems(Category $category): array;

    public function getTemplate(): string;

    /**
     * @return array<string,mixed>
     */
    public function getTemplateParameters(Category $category): array;
}