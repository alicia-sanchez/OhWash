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
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;


class DashboardController extends AbstractDashboardController
{


    private AdminUrlGenerator $adminUrlGenerator;
    private AuthorizationCheckerInterface $authorizationChecker;

    public function __construct(AdminUrlGenerator $adminUrlGenerator, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->authorizationChecker = $authorizationChecker;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->redirect($this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('OhWash');
    }



    public function configureMenuItems(): iterable
    {

        
        
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
    
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            // Éléments de menu pour les administrateurs
            yield MenuItem::subMenu('Utilisateurs', 'fa fa-users')->setSubItems([
                MenuItem::linkToCrud('Tous les Utilisateurs', 'fa fa-users', User::class),
                MenuItem::linkToCrud('Employés', 'fa fa-user-tie', User::class)
                    ->setController(EmployesCrudController::class),
            ]);
            yield MenuItem::subMenu('Orders', 'fas fa-shopping-cart')->setSubItems([
                MenuItem::linkToCrud('Tous les Orders', 'fas fa-list', Orders::class)
                    ->setController(OrdersCrudController::class),
                MenuItem::linkToCrud('Orders à traiter', 'fas fa-exclamation-circle', Orders::class)
                    ->setController(PendingOrdersCrudController::class),
            ]);
            yield MenuItem::linkToCrud('Articles', 'fas fa-tag', Article::class);
            yield MenuItem::linkToCrud('Catégories d\'articles', 'fas fa-tags', CategoryArticle::class);
            yield MenuItem::linkToCrud('Services', 'fas fa-concierge-bell', Service::class);
            yield MenuItem::linkToCrud('Catégories de services', 'fas fa-boxes', CategoryService::class);
        }
        
        if ($this->authorizationChecker->isGranted('ROLE_EMPLOYE')) {
            // Sous-menu spécifique pour les employés
            yield MenuItem::subMenu('Utilisateurs', 'fa fa-users')->setSubItems([
                MenuItem::linkToCrud('Employés', 'fa fa-user-tie', User::class)
                    ->setController(EmployesCrudController::class)
                    ->setAction(Action::INDEX), // Correction ici
            ]);
            yield MenuItem::linkToCrud('Orders', 'fas fa-shopping-cart', Orders::class);
                
        

        }
    }
}
