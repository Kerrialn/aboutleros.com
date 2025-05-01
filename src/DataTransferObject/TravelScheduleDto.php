<?php

namespace App\DataTransferObject;

readonly final class TravelScheduleDto
{
    public function __construct(
        private string $origin,
        private string $destination,
        private null|string $spcificDestination,
        private string $departure,
        private string $arrival,
        private string $day,
        private string $operator,
    )
    {
    }

    public function getOrigin(): string
    {
        return $this->origin;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getDeparture(): string
    {
        return $this->departure;
    }

    public function getArrival(): string
    {
        return $this->arrival;
    }

    public function getDay(): string
    {
        return $this->day;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function getSpcificDestination(): ?string
    {
        return $this->spcificDestination;
    }

}