<?php

namespace App\Entity;

use App\Enum\ContentTypeEnum;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    public $categories;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(UuidGenerator::class)]
    private Uuid|null $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    #[ORM\Column(type: Types::INTEGER, length: 2)]
    private null|int $displayOrder = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Business::class)]
    private Collection $businesses;

    #[ORM\Column(enumType: ContentTypeEnum::class)]
    private ContentTypeEnum $contentTypeEnum;

    public function __construct(
        ?string $title,
        ?string $description,
        ?string $slug,
        ?string $icon,
        ?string $image,
        ?string $color,
        ?ContentTypeEnum $contentTypeEnum,
        ?int $displayOrder
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->slug = $slug;
        $this->icon = $icon;
        $this->image = $image;
        $this->color = $color;
        $this->contentTypeEnum = $contentTypeEnum;
        $this->displayOrder = $displayOrder;
        $this->businesses = new ArrayCollection();
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection<int, Business>
     */
    public function getBusinesses(): Collection
    {
        return $this->businesses;
    }

    public function addBusiness(Business $business): void
    {
        if (! $this->businesses->contains($business)) {
            $this->businesses->add($business);
        }
    }

    public function removeBusiness(Business $business): void
    {
        if ($this->categories->contains($business)) {
            $this->categories->remove($business);
        }
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getContentTypeEnum(): ContentTypeEnum
    {
        return $this->contentTypeEnum;
    }

    public function setContentTypeEnum(ContentTypeEnum $contentTypeEnum): void
    {
        $this->contentTypeEnum = $contentTypeEnum;
    }

    public function __toString(): string
    {
        return $this->getSlug();
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDisplayOrder(): ?int
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder(?int $displayOrder): void
    {
        $this->displayOrder = $displayOrder;
    }
}
