<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class PendingOrdersCrudController extends AbstractCrudController 
{
    public static function getEntityFqcn(): string // Définition de l'entité associée au contrôleur
    {
        return Order::class;
    }
    public function configureActions(Actions $actions): Actions // Configuration des actions disponibles dans le CRUD
    {
        $actions = parent::configureActions($actions); // Désactivation des actions les non-administrateurs
        if (!$this->isGranted('ROLE_ADMIN')) {
            $actions->disable(Action::NEW, Action::EDIT, Action::DELETE);
        }
        return $actions;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            // Définition des différents champs et de leurs propriétés
            IdField::new('id')->hideOnDetail()->hideOnForm()->hideOnIndex(),
            TextField::new('status', 'Statut'),
            DateTimeField::new('status_date', 'Date du Statut'),
            DateTimeField::new('payment_date', 'Date de Paiement'),
            DateTimeField::new('deposit_date', 'Date de Dépôt'),
            DateTimeField::new('pickup_date', 'Date de Ramassage'),
            NumberField::new('total_price', 'Prix Total'),
            AssociationField::new('user', 'Utilisateur'),
            AssociationField::new('articles', 'Articles'),
            // Champ 'Employé Assigné' filtré pour ne montrer que les employés
            AssociationField::new('assignedEmployee', 'Employé Assigné')
                ->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                    $queryBuilder->andWhere('entity.isEmployee = true');
                }),
            AssociationField::new('Service', 'Services')
        ];
    }
    // Création d'une requête pour filtrer les commandes en attente
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, 
    FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $queryBuilder->andWhere('entity.status LIKE :status') // Filtrage pour n'afficher que les commandes en attente de traitement
                     ->setParameter('status', '%à traiter%');
    
        return $queryBuilder;
    }
}
