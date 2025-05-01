<?php

namespace App\Entity;

use App\Repository\HistoricalEventRepository;
use Carbon\CarbonImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: HistoricalEventRepository::class)]
class HistoricalEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(UuidGenerator::class)]
    private Uuid $id;

    #[ORM\Column(length: 255)]
    private null|string $title;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private null|string $description;

    #[ORM\Column(length: 255)]
    private null|string $location;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private null|CarbonImmutable $startAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private null|CarbonImmutable $endAt;

    /**
     * @var Collection<int, HistoricalEventImage>
     */
    #[ORM\OneToMany(mappedBy: 'historicalEvent', targetEntity: HistoricalEventImage::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    public function getStartAt(): ?CarbonImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(?CarbonImmutable $startAt): void
    {
        $this->startAt = $startAt;
    }

    public function getEndAt(): ?CarbonImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(?CarbonImmutable $endAt): void
    {
        $this->endAt = $endAt;
    }

    public function addImage(HistoricalEventImage $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setHistoricalEvent($this);
        }

        return $this;
    }

    public function removeImage(HistoricalEventImage $image): self
    {
        if ($image->getHistoricalEvent() === $this) {
            $this->images->removeElement($image);
        }

        return $this;
    }

    /**
     * @return Collection<int, HistoricalEventImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function getMainImage(): null|HistoricalEventImage
    {
        return $this->images->findFirst(fn(int $key, HistoricalEventImage $historicalEventImage): bool => $historicalEventImage->getPosition() === 0);
    }
}