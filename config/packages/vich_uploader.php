<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Vich\UploaderBundle\Naming\OrignameNamer;
use Vich\UploaderBundle\Naming\SmartUniqueNamer;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('vich_uploader', [
        'db_driver' => 'orm',
        'mappings' => [
            'historical_event_images' => [
                'uri_prefix' => '/uploads/historical_event_images',
                'upload_destination' => '%kernel.project_dir%/public/uploads/historical_event_images',
                'namer' => SmartUniqueNamer::class
            ],
            'business_images' => [
                'uri_prefix' => '/uploads/business_images',
                'upload_destination' => '%kernel.project_dir%/public/uploads/business_images',
                'namer' => OrignameNamer::class
            ]
        ]
    ]);
};
