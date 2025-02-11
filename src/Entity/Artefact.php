<?php

namespace App\Entity;

use App\Repository\ArtefactRepository;
use Carbon\CarbonImmutable;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ArtefactRepository::class)]
class Artefact
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(UuidGenerator::class)]
    private Uuid|null $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icon = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $color = null;

    /**
     * One Artefact has Many Artefacts.
     * @var Collection<int, Artefact>
     */
    #[ORM\OneToMany(mappedBy: 'artefact', targetEntity: Artefact::class)]
    private Collection $artefacts;

    #[ORM\ManyToOne(targetEntity: Artefact::class, inversedBy: 'artefact')]
    #[ORM\JoinColumn(name: 'artefact_id', referencedColumnName: 'id')]
    private Artefact|null $artefact = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private CarbonImmutable $createdAt;

    public function __construct(
        ?string $title,
        ?string $slug,
        ?string $icon,
        ?string $color
    )
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->icon = $icon;
        $this->color = $color;
        $this->artefacts = new ArrayCollection();
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

    public function getCreatedAt(): CarbonImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(CarbonImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getArtefact(): ?Artefact
    {
        return $this->artefact;
    }

    public function setArtefact(?Artefact $artefact): void
    {
        $this->artefact = $artefact;
    }

    /**
     * @return Collection<int, Artefact>
     */
    public function getArtefacts(): Collection
    {
        return $this->artefacts;
    }

    public function addArtefact(Artefact $artefact): void
    {
        if (!$this->artefacts->contains($artefact)) {
            $this->artefacts->add($artefact);
        }
    }

    public function removeArtefact(Artefact $artefact): void
    {
        if ($this->artefacts->contains($artefact)) {
            $this->artefacts->remove($artefact);
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

}
