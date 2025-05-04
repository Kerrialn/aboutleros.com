<?php

namespace App\Event\Listener;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RouterInterface;

#[AsEventListener(event: 'kernel.request', method: 'onKernelRequest')]
class MaintenanceListener
{
    public function __construct(
        private ParameterBagInterface $parameterBag,
        private RouterInterface $router
    )
    {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        $isUnderMaintenance = (bool) $this->parameterBag->get('app.is_under_maintenance');
        if (! $isUnderMaintenance || $request->get('_route') === 'maintenance') {
            return;
        }

        $maintenanceUrl = $this->router->generate('maintenance');

        $event->setResponse(new RedirectResponse($maintenanceUrl, 302));
    }
}
