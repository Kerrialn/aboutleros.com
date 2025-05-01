<?php

namespace App\Entity\Contract;

interface CategorizableInterface
{
    public function getTitle(): string;

    public function setTitle(string $title): void;
}