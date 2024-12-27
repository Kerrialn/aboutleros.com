<?php

namespace App\Entity;

use App\Enum\ItemStatusEnum;
use App\Enum\ItemTypeEnum;
use App\Repository\ItemRepository;
use Carbon\CarbonImmutable;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(UuidGenerator::class)]
    private Uuid|null $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?string $imagePath = null;

    #[ORM\Column(enumType: ItemTypeEnum::class)]
    private null|ItemTypeEnum $itemTypeEnum = ItemTypeEnum::NEWS;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private CarbonImmutable $createdAt;

    #[ORM\Column(nullable: true)]
    private null|DateTimeImmutable $startAt;

    #[ORM\Column(nullable: true)]
    private null|int $durationInMinutes = null;

    #[ORM\Column(enumType: ItemStatusEnum::class)]
    private null|ItemStatusEnum $itemStatusEnum = ItemStatusEnum::PENDING;

    public function __construct()
    {
        $this->createdAt = new CarbonImmutable();
    }

    public function getId(): null|Uuid
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getItemTypeEnum(): ?ItemTypeEnum
    {
        return $this->itemTypeEnum;
    }

    public function setItemTypeEnum(?ItemTypeEnum $itemTypeEnum): void
    {
        $this->itemTypeEnum = $itemTypeEnum;
    }

    public function getCreatedAt(): CarbonImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(CarbonImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getItemStatusEnum(): ?ItemStatusEnum
    {
        return $this->itemStatusEnum;
    }

    public function setItemStatusEnum(?ItemStatusEnum $itemStatusEnum): void
    {
        $this->itemStatusEnum = $itemStatusEnum;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(?string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function getStartAt(): ?DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(?DateTimeImmutable $startAt): void
    {
        $this->startAt = $startAt;
    }

    public function getDurationInMinutes(): ?int
    {
        return $this->durationInMinutes;
    }

    public function setDurationInMinutes(?int $durationInMinutes): void
    {
        $this->durationInMinutes = $durationInMinutes;
    }

}
