<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Cache l'ID lors de la création/édition
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            EmailField::new('email', 'Email'),
            TextField::new('gender', 'Genre'),
            TextField::new('city', 'Ville'),
            IntegerField::new('zipCode', 'Code Postal'),
            // Configuration pour afficher les rôles
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
    
}
