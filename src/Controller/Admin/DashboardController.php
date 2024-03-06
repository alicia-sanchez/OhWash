<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\CategoryArticle;
use App\Entity\CategoryService;
use App\Entity\Order;
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

    private AdminUrlGenerator $adminUrlGenerator; // Utilisé pour générer des URL vers les pages d'administration
    private AuthorizationCheckerInterface $authorizationChecker; // Utilisé pour vérifier les autorisations des utilisateurs

    public function __construct(AdminUrlGenerator $adminUrlGenerator, AuthorizationCheckerInterface $authorizationChecker)
    {
        // Initialisation des propriétés avec les valeurs passées en paramètres
        $this->adminUrlGenerator = $adminUrlGenerator;
        $this->authorizationChecker = $authorizationChecker;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Redirection vers la première page d'administration (la page des utilisateurs)
        return $this->redirect($this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }
    // Configuration générale du dashboard
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('OhWash');
    }
    // Configuration des éléments de menu dans le dashboard
    public function configureMenuItems(): iterable
    {
        // Lien vers le dashboard
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // Vérification des autorisations pour afficher les éléments de menu en fonction du rôle de l'utilisateur
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            // Éléments de menu pour les admins
            yield MenuItem::subMenu('Utilisateurs', 'fa fa-users')->setSubItems([ //Menu "Utilisateurs"
                MenuItem::linkToCrud('Tous les Utilisateurs', 'fa fa-users', User::class), //Sous menu "Tous les utilisateurs"
                MenuItem::linkToCrud('Employés', 'fa fa-user-tie', User::class) //Sous menu "Employés"
                    ->setController(EmployesCrudController::class),
            ]);
            
            yield MenuItem::subMenu('Commandes', 'fas fa-shopping-cart')->setSubItems([ //Menu "Commandes"
                MenuItem::linkToCrud('Toutes les commandes', 'fas fa-list', Order::class) //Sous menu "Toutes les commandes"
                    ->setController(OrdersCrudController::class),
                //Sous menu "Commandes à traiter"
                MenuItem::linkToCrud('Commandes à traiter', 'fas fa-exclamation-circle', Order::class)
                    ->setController(PendingOrdersCrudController::class),
            ]);
            
            yield MenuItem::linkToCrud('Articles', 'fas fa-tag', Article::class); //Menu Article
            yield MenuItem::linkToCrud('Catégories d\'articles', 'fas fa-tags', CategoryArticle::class); //Menu Categorie d'Article
            yield MenuItem::linkToCrud('Services', 'fas fa-concierge-bell', Service::class); //Menu Service
            yield MenuItem::linkToCrud('Catégories de services', 'fas fa-boxes', CategoryService::class); //Menu Categorie Service
        }
        //Vérification si l'utilisateur à le role Employé
        if ($this->authorizationChecker->isGranted('ROLE_EMPLOYE')) {
            yield MenuItem::subMenu('Utilisateurs', 'fa fa-users')->setSubItems([ // Menu spécifique pour les employés
                MenuItem::linkToCrud('Employés', 'fa fa-user-tie', User::class) //Sous menu "employés"
                    ->setController(EmployesCrudController::class)
                    ->setAction(Action::INDEX)
            ]);
            yield MenuItem::linkToCrud('Commandes', 'fas fa-shopping-cart', Order::class); //Menu Commandes
        }
    }
}
