<?php

declare(strict_types=1);

use App\Controller\Controller\DiscoverController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;

return static function (ContainerConfigurator $container): void {
    $parameters = $container->parameters();
    $parameters->set('app.is_under_maintenance', '%env(APP_UNDER_MAINTENANCE)%');
    $container->import(__DIR__ . '/packages/data/*.php');

    $services = $container->services();
    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\', __DIR__ . '/../src/')
        ->exclude([
            __DIR__ . '/../src/DependencyInjection/',
            __DIR__ . '/../src/Entity/',
            __DIR__ . '/../src/Kernel.php',
        ]);

    // ----------------------------------------------------------------
    // Override the DiscoverController to inject tagged handlers
    // ----------------------------------------------------------------
    $services->set(DiscoverController::class)
        // keep CategoryRepository autowired, override only $handlers
        ->arg('$handlers', tagged_iterator('app.category_handler'));
};
