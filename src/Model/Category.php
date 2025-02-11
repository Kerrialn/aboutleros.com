<?php

namespace App\Model;

final readonly class Category
{
    private string $title;
    private string $icon;
    private string $color;

    /**
     * @param string $title
     * @param string $icon
     * @param string $color
     */
    public function __construct(string $title, string $icon, string $color)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->color = $color;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getColor(): string
    {
        return $this->color;
    }

}