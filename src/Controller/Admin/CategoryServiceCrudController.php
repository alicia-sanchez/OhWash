<?php

namespace App\Controller\Admin;

use App\Entity\CategoryService;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use PhpParser\Node\Expr\Cast\Array_;

class CategoryServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryService::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('name'),
            AssociationField::new('services')
            ->onlyOnIndex(),
            ArrayField::new('services')
            ->onlyOnDetail(),
        ];
    }

}
