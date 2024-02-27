<?php

namespace App\Controller\Admin;

use App\Entity\Orders;
use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Asset;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;



class OrdersCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;
    private AdminUrlGenerator $adminUrlGenerator;

    public function __construct(EntityManagerInterface $entityManager, AdminUrlGenerator $adminUrlGenerator)
    {
        $this->entityManager = $entityManager;
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

    public function configureActions(Actions $actions): Actions
    {
        $setInProgress = Action::new('setInProgress', 'en cours', 'fa fa-running')
        ->linkToCrudAction('setOrderStatusInProgress')
        ->setCssClass('btn btn-warning')
        ->displayIf(static function ($entity) {
            return in_array($entity->getStatus(), ['à traiter']); // Ajustez selon vos valeurs réelles
        });
    
    $setCompleted = Action::new('setCompleted', 'terminée', 'fa fa-check')
        ->linkToCrudAction('setOrderStatusCompleted')
        ->setCssClass('btn btn-success')
        ->displayIf(static function ($entity) {
            return $entity->getStatus() === 'en cours'; // Ajustez selon vos valeurs réelles
        });
    

        $actions = parent::configureActions($actions);

        if ($this->isGranted('ROLE_EMPLOYE')) {
            $actions
                ->add(Crud::PAGE_INDEX, $setInProgress)
                ->add(Crud::PAGE_INDEX, $setCompleted);
        }

        return $actions;
    }

    public function setOrderStatusInProgress(AdminContext $context)
    {
        $orderId = $context->getRequest()->get('entityId');
        $order = $this->entityManager->getRepository(Orders::class)->find($orderId);

        if ($order) {
            $order->setStatus('en cours');
            $this->entityManager->flush();
        }

        return $this->redirect($context->getReferrer());
    }

    public function setOrderStatusCompleted(AdminContext $context)
    {
        $orderId = $context->getRequest()->get('entityId');
        $order = $this->entityManager->getRepository(Orders::class)->find($orderId);

        if ($order) {
            $order->setStatus('terminée');
            $this->entityManager->flush();
        }

        return $this->redirect($context->getReferrer());
    }



}
