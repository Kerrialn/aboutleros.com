<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $c): void {
    $c->parameters()
        ->set('app.data.flight_schedule', [
            [
                'flight_number' => 'OA31',
                'origin' => 'LRS',
                'destination' => 'ATH',
                'departure' => '10:10',
                'arrival' => '11:10',
                'days' => ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'],
                'operator' => 'Olympic Air',
            ],
            [
                'flight_number' => 'OA30',
                'origin' => 'ATH',
                'destination' => 'LRS',
                'departure' => '08:45',
                'arrival' => '09:45',
                'days' => ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'],
                'operator' => 'Olympic Air',
            ],
        ]);
};
