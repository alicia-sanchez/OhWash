<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;



class OrdersCrudController extends AbstractCrudController
{
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    public static function getEntityFqcn(): string
    {
        return Orders::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnDetail()->hideOnForm()->hideOnIndex(),
            TextField::new('status', 'Statut'),
            DateTimeField::new('status_date', 'Date du Statut'),
            DateTimeField::new('payement_date', 'Date de Paiement'),
            DateTimeField::new('deposit_date', 'Date de Dépôt'),
            DateTimeField::new('pickup_date', 'Date de Ramassage'),
            NumberField::new('total_price', 'Prix Total'),
            AssociationField::new('user', 'Utilisateur'),
            AssociationField::new('articles', 'Articles'),
            AssociationField::new('assignedEmployee', 'Employé Assigné'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        // Ici, vous pouvez configurer vos actions comme vous le souhaitez. 
        // Par exemple, ajouter une action personnalisée, modifier des actions existantes, etc.
        // Exemple d'ajout d'une action détail si elle n'est pas déjà présente par défaut :
        $actions->add(Crud::PAGE_INDEX, Action::DETAIL);

        // Assurez-vous de retourner l'objet $actions à la fin
        return $actions;
    }

    public function redirectToAssignOrder(int $orderId, int $employeeId): RedirectResponse
{
    return $this->redirect($this->generateUrl('assign_order_to_employee', [
        'orderId' => $orderId,
        'employeeId' => $employeeId
    ]));
}



public function someAction(Request $request): RedirectResponse
{
    $orderId = $request->get('orderId');
    $employeeId = $request->get('employeeId');

    // Assurez-vous de valider et de vérifier les valeurs ici

    return $this->redirect($this->generateUrl('assign_order_to_employee', [
        'orderId' => $orderId,
        'employeeId' => $employeeId
    ]));
}

public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
{
    // Simplement retourner le queryBuilder de la méthode parent sans filtrage supplémentaire
    return parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
}






}
