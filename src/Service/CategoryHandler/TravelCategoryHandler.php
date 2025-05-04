<?php

namespace App\Service\CategoryHandler;

use App\DataTransferObject\ItemDto;
use App\DataTransferObject\TravelScheduleDto;
use App\Entity\Category;
use App\Enum\ContentTypeEnum;
use App\Repository\EventRepository;
use App\Service\CategoryHandler\Contract\CategoryHandlerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AutoconfigureTag('app.category_handler')]
final readonly class TravelCategoryHandler implements CategoryHandlerInterface
{
    /**
     * @param array<mixed>  $flightSchedule
     * @param array<mixed> $ferrySchedule
     */
    public function __construct(
        private EventRepository $eventRepository,
        private UrlGeneratorInterface $urlGenerator,
        #[Autowire('%app.data.flight_schedule%')]
        private array $flightSchedule,
        #[Autowire('%app.data.ferry_schedule%')]
        private array $ferrySchedule,
    )
    {
    }

    public function supports(Category $category): bool
    {
        return $category->getContentTypeEnum() === ContentTypeEnum::TRAVEL_AND_TRANSPORT;
    }

    public function fetchItems(Category $category): array
    {
        return array_map(
            fn($event): \App\DataTransferObject\ItemDto => new ItemDto(
                title: $event->getTitle(),
                image: null,
                route: $this->urlGenerator->generate('show_event', [
                    'id' => $event->getId(),
                ])
            ),
            $this->eventRepository->findStartingSoon()
        );
    }

    public function getTemplate(): string
    {
        return 'discover/travel.html.twig';
    }

    public function getTemplateParameters(Category $category): array
    {
        $items = $this->fetchItems($category);

        // get the full list of flight DTOs
        $allFlights = $this->getFlightSchedule();

        // departures: origin = Leros
        $flightDepartures = array_filter(
            $allFlights,
            fn(TravelScheduleDto $f): bool => $f->getOrigin() === 'Leros'
        );

        // arrivals: destination = Leros
        $flightArrivals = array_filter(
            $allFlights,
            fn(TravelScheduleDto $f): bool => $f->getDestination() === 'Leros'
        );

        // same for ferries...
        $allFerries = $this->getFerrySchedule();
        $ferryDepartures = array_filter($allFerries, fn($f): bool => $f->getOrigin() === 'Leros');
        $ferryArrivals = array_filter($allFerries, fn($f): bool => $f->getDestination() === 'Leros');

        return [
            'category' => $category,
            'items' => $items,
            'flights' => [
                'departures' => $flightDepartures,
                'arrivals' => $flightArrivals,
            ],
            'ferry' => [
                'departures' => $ferryDepartures,
                'arrivals' => $ferryArrivals,
            ],
        ];
    }

    /**
     * @return array<int, TravelScheduleDto>
     */
    private function getFlightSchedule(): array
    {
        $out = [];
        foreach ($this->flightSchedule as $leg) {
            foreach ($leg['days'] as $day) {
                // outbound LRS→ATH
                if ($leg['origin'] === 'LRS' && $leg['destination'] === 'ATH') {
                    $out[] = new TravelScheduleDto(
                        origin: 'Leros',
                        destination: 'Athens',
                        spcificDestination: null,
                        departure: $leg['departure'],
                        arrival: $leg['arrival'],
                        day: ucfirst($day),
                        operator: $leg['operator'],
                    );
                }
                // inbound ATH→LRS
                if ($leg['origin'] === 'ATH' && $leg['destination'] === 'LRS') {
                    $out[] = new TravelScheduleDto(
                        origin: 'Athens',
                        destination: 'Leros',
                        spcificDestination: null,
                        departure: $leg['departure'],
                        arrival: $leg['arrival'],
                        day: ucfirst($day),
                        operator: $leg['operator'],
                    );
                }
            }
        }

        return $out;
    }

    /**
     * @return array<int, TravelScheduleDto>
     */
    private function getFerrySchedule(): array
    {
        $out = [];
        foreach ($this->ferrySchedule as $leg) {
            foreach ($leg['days'] as $day) {
                // map any leg (regardless of destination) into a DTO
                $originName = $leg['origin'] === 'LRS' ? 'Leros' : $leg['origin'];
                $destinationName = $leg['destination'] === 'LRS' ? 'Leros' : $leg['destination'];
                $destinationPort = $leg['destination'] === 'LRS' ? $leg['destination_port'] : null;

                $out[] = new TravelScheduleDto(
                    origin: $originName,
                    destination: $destinationName,
                    spcificDestination: $destinationPort,
                    departure:   $leg['departure'],
                    arrival:     $leg['arrival'],
                    day:         ucfirst($day),
                    operator:    $leg['operator'],
                );
            }
        }

        return $out;
    }
}
