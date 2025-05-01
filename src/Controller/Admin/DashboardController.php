<?php

namespace App\Controller\Admin;

use App\Entity\Business;
use App\Entity\Category;
use App\Entity\Event;
use App\Entity\HistoricalEvent;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(HistoricalEventCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('aboutleros.com');
    }

    public function configureMenuItems(): iterable
    {
         yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
         yield MenuItem::linkToCrud('Event', 'fas fa-list', Event::class);
         yield MenuItem::linkToCrud('Business', 'fas fa-list', Business::class);
         yield MenuItem::linkToCrud('Historical Event', 'fas fa-list', HistoricalEvent::class);
    }
}
