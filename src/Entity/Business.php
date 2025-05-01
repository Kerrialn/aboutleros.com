<?php

namespace App\Entity;

use App\Entity\Contract\CategorizableInterface;
use App\Enum\ItemStatusEnum;
use App\Enum\TypeEnum;
use App\Repository\BusinessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: BusinessRepository::class)]
class Business implements CategorizableInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(UuidGenerator::class)]
    private Uuid|null $id = null;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(enumType: ItemStatusEnum::class)]
    private null|TypeEnum $businessTypeEnum = TypeEnum::STANDARD;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'businesses')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private Category|null $category = null;

    /**
     * @var Collection<int, HistoricalEventImage>
     */
    #[ORM\OneToMany(mappedBy: 'business', targetEntity: BusinessImage::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    public function getBusinessTypeEnum(): ?TypeEnum
    {
        return $this->businessTypeEnum;
    }

    public function setBusinessTypeEnum(?TypeEnum $businessTypeEnum): void
    {
        $this->businessTypeEnum = $businessTypeEnum;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    public function addImage(BusinessImage $image): self
    {
        if (! $this->images->contains($image)) {
            $this->images->add($image);
            $image->setBusiness($this);
        }

        return $this;
    }

    public function removeImage(BusinessImage $image): self
    {
        if ($this->images->removeElement($image) && $image->getBusiness() === $this) {
            $image->setBusiness(null);
        }

        return $this;
    }

    /**
     * @return Collection<int, BusinessImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function getMainImage(): BusinessImage
    {
        return $this->images->findFirst(fn(int $key, BusinessImage $businessImage): bool => $businessImage->getPosition() === 0);
    }
}