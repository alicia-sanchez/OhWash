<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class EmployesCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
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
            IdField::new('id')->hideOnForm(),
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            EmailField::new('email', 'Email'),
            TextField::new('gender', 'Genre'),
            TextField::new('city', 'Ville'),
            IntegerField::new('zipCode', 'Code Postal'),
            ArrayField::new('roles', 'Rôles')
                ->formatValue(function ($value, $entity) {
                    // Vérifiez si $entity est non-null avant de continuer
                    if (!$entity) {
                        return 'Non assigné'; // ou toute autre valeur par défaut appropriée
                    }

                    $roles = $entity->getRoles();
                    $roleLabels = ['ROLE_ADMIN' => 'Administrateur', 'ROLE_EMPLOYE' => 'Employé', 'ROLE_USER' => 'Utilisateur'];

                    foreach ($roleLabels as $role => $label) {
                        if (in_array($role, $roles)) {
                            return $label;
                        }
                    }

                    return 'Inconnu';
                }),

        ];
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
    
        // Pour une colonne de type texte contenant une représentation JSON des rôles :
        $queryBuilder->andWhere('entity.role LIKE :role')
                     ->setParameter('role', '%"ROLE_EMPLOYE"%');
    
        return $queryBuilder;
    }
    
}
