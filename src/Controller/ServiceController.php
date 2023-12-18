<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\CategoryService;

class ServiceController extends AbstractController
{
    #[Route('/api/services/byCategory/{categoryId}', name: 'services_by_category')]
    public function getServicesByCategory($categoryId, ManagerRegistry $doctrine): Response
    {
        $categoryServiceRepository = $doctrine->getRepository(CategoryService::class);
        $categoryService = $categoryServiceRepository->find($categoryId);
    
        if (!$categoryService) {
            return $this->json(['message' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }
    
        $services = $categoryService->getServices();
    
        return $this->json($services);
    }
    
}
