<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\CategoryArticle;
use App\Entity\CategoryService;
use App\Entity\Orders;
use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Rediriger vers un contrôleur par défaut ou vers une page spécifique si nécessaire
        // Cela pourrait être la page de vue d'ensemble des commandes, des utilisateurs, ou toute autre page de votre choix
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('OhWash');
    }

    public function configureMenuItems(): iterable
    {
        // Tableau de bord principal
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
    
        // Sous-menu pour les utilisateurs avec deux entrées: tous les utilisateurs et employés
        yield MenuItem::subMenu('Utilisateurs', 'fa fa-users')->setSubItems([
            MenuItem::linkToCrud('Tous les Utilisateurs', 'fa fa-users', User::class),
            MenuItem::linkToCrud('Employés', 'fa fa-user-tie', User::class)
                ->setController(EmployesCrudController::class),
        ]);
    
        // Sous-menu pour les commandes avec deux entrées: toutes les commandes et commandes non traitées
        yield MenuItem::subMenu('Orders', 'fas fa-shopping-cart')->setSubItems([
            MenuItem::linkToCrud('Tous les Orders', 'fas fa-list', Orders::class),
            MenuItem::linkToCrud('Orders Non Traités', 'fas fa-times-circle', Orders::class)
                ->setController(PendingOrdersCrudController::class),
        ]);
    
        // Liens directs pour Articles, Catégories d'articles, Services, et Catégories de services
        yield MenuItem::linkToCrud('Articles', 'fas fa-tag', Article::class);
        yield MenuItem::linkToCrud('Catégories d\'articles', 'fas fa-tags', CategoryArticle::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-concierge-bell', Service::class);
        yield MenuItem::linkToCrud('Catégories de services', 'fas fa-boxes', CategoryService::class);
    }
    
}
