<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdersController extends AbstractController
{
    #[Route('/assign/order/{orderId}/employee/{employeeId}', name: 'assign_order_to_employee')]
    public function assignOrderToEmployee($orderId, $employeeId): Response
    {
        // Ici, vous récupérez les entités Order et Employee en utilisant $orderId et $employeeId
        // Puis, vous effectuez l'assignation et sauvegardez les changements dans la base de données

        // Retourner une réponse ou rediriger l'utilisateur
        return new Response('Commande assignée à l\'employé');
    }
}
