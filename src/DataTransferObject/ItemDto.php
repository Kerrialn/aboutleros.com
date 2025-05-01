<?php

namespace App\DataTransferObject;

readonly final class ItemDto
{

    public function __construct(
        private string $title,
        private null|string $image,
        private string $route,
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getImage(): null|string
    {
        return $this->image;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

}
