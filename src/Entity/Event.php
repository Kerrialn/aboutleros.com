<?php

namespace App\Entity;

use App\Entity\Contract\CategorizableInterface;
use App\Repository\EventRepository;
use Carbon\CarbonImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event implements CategorizableInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(UuidGenerator::class)]
    private Uuid|null $id = null;
    #[ORM\Column(length: 255)]
    private string $title;
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private null|string $description;
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private null|CarbonImmutable $startAt;
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private null|CarbonImmutable $endAt;
    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getStartAt(): CarbonImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = CarbonImmutable::instance($startAt);

        return $this;
    }

    public function getEndAt(): CarbonImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = CarbonImmutable::instance($endAt);

        return $this;
    }

}