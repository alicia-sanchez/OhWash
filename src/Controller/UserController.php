<?php

// src/Controller/UserController.php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function index(UserRepository $userRepository): Response
    {
        $allUsers = $userRepository->findAll();
        $employes = [];

        foreach ($allUsers as $user) {
            // Vérifie si l'utilisateur a le rôle EMPLOYE
            if (in_array('ROLE_EMPLOYE', $user->getRoles())) {
                $employes[] = $user;
            }
        }

        return $this->render('user/index.html.twig', [
            'users' => $employes,
        ]);
    }
}

