<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $c) {
    $c->parameters()
        ->set('app.data.ferry_schedule', [

            // ─── DEPARTURES FROM LEROS ────────────────────────────────────────

            // Leros → Piraeus (Athens) via Blue Star Ferries
            [
                'ferry_number' => 'Blue Star Ferries',
                'origin' => 'LRS',
                'destination' => 'ATH',
                'departure' => '23:00',
                'arrival' => '08:25',
                'days' => ['sun'],
                'operator' => 'Blue Star Ferries',
            ],  // 1× weekly (Sun) :contentReference[oaicite:0]{index=0}

            [
                'ferry_number' => 'Blue Star Ferries',
                'origin' => 'LRS',
                'destination' => 'ATH',
                'departure' => '00:30',
                'arrival' => '10:35',
                'days' => ['wed', 'fri', 'sun'],
                'operator' => 'Blue Star Ferries',
            ],  // 3× weekly (Wed, Fri, Sun) :contentReference[oaicite:1]{index=1}

            // Leros → Kalymnos (3× weekly)
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'LRS',
                'destination' => 'Kalymnos',
                'departure' => '14:25',
                'arrival' => '15:05',
                'days' => ['mon', 'wed', 'fri'],
                'operator' => 'Dodekanisos Seaways',
            ],  // 3 sailings weekly :contentReference[oaicite:2]{index=2}

            // Leros → Kos (7× weekly)
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'LRS',
                'destination' => 'Kos',
                'departure' => '14:25',
                'arrival' => '15:45',
                'days' => ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'],
                'operator' => 'Dodekanisos Seaways',
            ],  // daily :contentReference[oaicite:3]{index=3}

            // Leros → Rhodes (4× weekly)
            [
                'ferry_number' => 'Blue Star Ferries',
                'origin' => 'LRS',
                'destination' => 'Rhodes',
                'departure' => '08:05',
                'arrival' => '12:30',
                'days' => ['wed', 'fri', 'sun', 'thu'],
                'operator' => 'Blue Star Ferries',
            ],  // 4 sailings weekly :contentReference[oaicite:4]{index=4}

            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'LRS',
                'destination' => 'Rhodes',
                'departure' => '13:30',
                'arrival' => '17:20',
                'days' => ['mon', 'sun'],
                'operator' => 'Dodekanisos Seaways',
            ],  // 2 sailings weekly :contentReference[oaicite:5]{index=5}

            // Leros → Patmos (2× weekly)
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'LRS',
                'destination' => 'Patmos',
                'departure' => '12:45',
                'arrival' => '13:35',
                'days' => ['tue', 'thu'],
                'operator' => 'Dodekanisos Seaways',
            ],  // 2 sailings weekly :contentReference[oaicite:6]{index=6}

            // Leros → Lipsi (7× weekly)
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'LRS',
                'destination' => 'Lipsi',
                'departure' => '13:15',
                'arrival' => '13:40',
                'days' => ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'],
                'operator' => 'Dodekanisos Seaways',
            ],  // daily :contentReference[oaicite:7]{index=7}

            // Leros → Symi (3× weekly)
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'LRS',
                'destination' => 'Symi',
                'departure' => '15:10',
                'arrival' => '17:00',
                'days' => ['wed', 'fri', 'sun'],
                'operator' => 'Dodekanisos Seaways',
            ],  // 3 sailings weekly :contentReference[oaicite:8]{index=8}

            // Leros → Agathonisi (2× weekly)
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'LRS',
                'destination' => 'Agathonisi',
                'departure' => '16:00',
                'arrival' => '17:00',
                'days' => ['tue', 'thu'],
                'operator' => 'Dodekanisos Seaways',
            ],  // 2 sailings weekly :contentReference[oaicite:9]{index=9}


            // ─── ARRIVALS INTO LEROS ─────────────────────────────────────────

            // Piraeus → Leros via Blue Star Ferries
            [
                'ferry_number' => 'Blue Star Ferries',
                'origin' => 'ATH',
                'destination' => 'LRS',
                'departure' => '15:00',
                'arrival' => '01:15',
                'days' => ['sun'],
                'operator' => 'Blue Star Ferries',
                'destination_port' => 'Lakki Harbour',
            ],
            [
                'ferry_number' => 'Blue Star Ferries',
                'origin' => 'ATH',
                'destination' => 'LRS',
                'departure' => '18:00',
                'arrival' => '03:35',
                'days' => ['wed', 'fri'],
                'operator' => 'Blue Star Ferries',
                'destination_port' => 'Lakki Harbour',
            ],

            // Kalymnos → Leros via Dodekanisos Seaways
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'Kalymnos',
                'destination' => 'LRS',
                'departure' => '10:55',
                'arrival' => '11:35',
                'days' => ['mon', 'wed', 'fri'],
                'operator' => 'Dodekanisos Seaways',
                'destination_port' => 'Agia Marina',
            ],

            // Kos → Leros
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'Kos',
                'destination' => 'LRS',
                'departure' => '10:25',
                'arrival' => '11:50',
                'days' => ['mon', 'tue', 'sun'],
                'operator' => 'Dodekanisos Seaways',
                'destination_port' => 'Agia Marina',
            ],
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'Kos',
                'destination' => 'LRS',
                'departure' => '10:15',
                'arrival' => '11:35',
                'days' => ['thu', 'sat'],
                'operator' => 'Dodekanisos Seaways',
                'destination_port' => 'Agia Marina',
            ],
            [
                'ferry_number' => 'Blue Star Ferries',
                'origin' => 'Kos',
                'destination' => 'LRS',
                'departure' => '20:30',
                'arrival' => '22:15',
                'days' => ['wed'],
                'operator' => 'Blue Star Ferries',
                'destination_port' => 'Lakki Harbour',
            ],

            // Rhodes → Leros
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'Rhodes',
                'destination' => 'LRS',
                'departure' => '08:00',
                'arrival' => '11:50',
                'days' => ['mon', 'sun'],
                'operator' => 'Dodekanisos Seaways',
                'destination_port' => 'Lakki Harbour',
            ],
            [
                'ferry_number' => 'Blue Star Ferries',
                'origin' => 'Rhodes',
                'destination' => 'LRS',
                'departure' => '04:05',
                'arrival' => '09:40',
                'days' => ['fri', 'sun'],
                'operator' => 'Blue Star Ferries',
                'destination_port' => 'Agia Marina',
            ],

            // Patmos → Leros
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'Patmos',
                'destination' => 'LRS',
                'departure' => '12:45',
                'arrival' => '13:35',
                'days' => ['tue', 'thu'],
                'operator' => 'Dodekanisos Seaways',
                'destination_port' => 'Agia Marina',
            ],

            // Lipsi → Leros
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'Lipsi',
                'destination' => 'LRS',
                'departure' => '13:05',
                'arrival' => '13:30',
                'days' => ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'],
                'operator' => 'Dodekanisos Seaways',
                'destination_port' => 'Lakki Harbour',
            ],

            // Symi → Leros
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'Symi',
                'destination' => 'LRS',
                'departure' => '08:55',
                'arrival' => '10:00',
                'days' => ['wed', 'fri', 'sun'],
                'operator' => 'Dodekanisos Seaways',
                'destination_port' => 'Agia Marina',
            ],

            // Agathonisi → Leros
            [
                'ferry_number' => 'Dodekanisos Seaways',
                'origin' => 'Agathonisi',
                'destination' => 'LRS',
                'departure' => '13:35',
                'arrival' => '14:00',
                'days' => ['tue', 'thu'],
                'operator' => 'Dodekanisos Seaways',
                'destination_port' => 'Agia Marina',
            ],

        ]);
};