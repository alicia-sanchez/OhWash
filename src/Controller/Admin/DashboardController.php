<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\CategoryArticle;
use App\Entity\CategoryService;
use App\Entity\Orders;
use App\Entity\Service;
use App\Entity\User;
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
         return $this->redirect($adminUrlGenerator->setController(CategoryServiceCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ohwash');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('User', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Orders', 'fas fa-shopping-cart', Orders::class);
        yield MenuItem::linkToCrud('CategoryService', 'fas fa-boxes', CategoryService::class);
        yield MenuItem::linkToCrud('Service', 'fas fa-clipboard-list', Service::class);
        yield MenuItem::linkToCrud('CategoryArticle', 'fas fa-folder-open', CategoryArticle::class);
        yield MenuItem::linkToCrud('Article', 'fas fa-shopping-bag', Article::class);
    }
}
