<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
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
    public static function getEntityFqcn(): string
    {
        return Orders::class;
    }

    public function configureActions(Actions $actions): Actions
{
    $actions = parent::configureActions($actions);

    if (!$this->isGranted('ROLE_ADMIN')) {
        $actions->disable(Action::NEW, Action::EDIT, Action::DELETE);
    }

    return $actions;
}


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnDetail()->hideOnForm()->hideOnIndex(),
            TextField::new('status', 'Statut'),
            DateTimeField::new('status_date', 'Date du Statut'),
            DateTimeField::new('payment_date', 'Date de Paiement'),
            DateTimeField::new('deposit_date', 'Date de Dépôt'),
            DateTimeField::new('pickup_date', 'Date de Ramassage'),
            NumberField::new('total_price', 'Prix Total'),
            AssociationField::new('user', 'Utilisateur'),
            AssociationField::new('articles', 'Articles'),
            AssociationField::new('assignedEmployee', 'Employé Assigné'),
            AssociationField::new('Service', 'Services')
            ->setCrudController(ServiceCrudController::class)
        ];
    }



    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
    
        // Pour une colonne de type texte contenant une représentation JSON des rôles :
        $queryBuilder->andWhere('entity.status LIKE :status')
                     ->setParameter('status', '%à traiter%');
    
        return $queryBuilder;
    }
    
}

