<?php

namespace App\Entity;

use App\Enum\AccommodationTypeEnum;
use App\Enum\TravelMotivationEnum;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: FeedbackRepository::class)]
class Feedback
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(UuidGenerator::class)]
    private Uuid|null $id = null;

    #[ORM\Column(length: 255)]
    private null|string $name;

    #[ORM\Column]
    private null|int $durationOfStayInDays;

    #[ORM\Column(enumType: AccommodationTypeEnum::class)]
    private null|AccommodationTypeEnum $accommodationTypeEnum;

    #[ORM\Column(enumType: TravelMotivationEnum::class)]
    private null|TravelMotivationEnum $travelMotivation;

    #[ORM\Column]
    private null|int $satisfactionRating;

    #[ORM\Column]
    private null|int $likelihoodOfRecommending;

    #[ORM\Column]
    private null|int $likelihoodToReturn;

    #[ORM\Column(length: 500)]
    private null|string $improvementSuggestions;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDurationOfStayInDays(): ?int
    {
        return $this->durationOfStayInDays;
    }

    public function setDurationOfStayInDays(?int $durationOfStayInDays): void
    {
        $this->durationOfStayInDays = $durationOfStayInDays;
    }

    public function getAccommodationTypeEnum(): ?AccommodationTypeEnum
    {
        return $this->accommodationTypeEnum;
    }

    public function setAccommodationTypeEnum(?AccommodationTypeEnum $accommodationTypeEnum): void
    {
        $this->accommodationTypeEnum = $accommodationTypeEnum;
    }

    public function getTravelMotivation(): ?TravelMotivationEnum
    {
        return $this->travelMotivation;
    }

    public function setTravelMotivation(?TravelMotivationEnum $travelMotivation): void
    {
        $this->travelMotivation = $travelMotivation;
    }

    public function getSatisfactionRating(): ?int
    {
        return $this->satisfactionRating;
    }

    public function setSatisfactionRating(?int $satisfactionRating): void
    {
        $this->satisfactionRating = $satisfactionRating;
    }

    public function getLikelihoodOfRecommending(): ?int
    {
        return $this->likelihoodOfRecommending;
    }

    public function setLikelihoodOfRecommending(?int $likelihoodOfRecommending): void
    {
        $this->likelihoodOfRecommending = $likelihoodOfRecommending;
    }

    public function getLikelihoodToReturn(): ?int
    {
        return $this->likelihoodToReturn;
    }

    public function setLikelihoodToReturn(?int $likelihoodToReturn): void
    {
        $this->likelihoodToReturn = $likelihoodToReturn;
    }


    public function getImprovementSuggestions(): ?string
    {
        return $this->improvementSuggestions;
    }

    public function setImprovementSuggestions(?string $improvementSuggestions): void
    {
        $this->improvementSuggestions = $improvementSuggestions;
    }



}