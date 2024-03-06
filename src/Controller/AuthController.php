<?php


namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthController extends AbstractController
{
    #[Route('/signup', name: 'app_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
{
    $data = json_decode($request->getContent(), true);

    if (!$data || !isset($data['email']) || !isset($data['password'])) {
        return $this->json(['status' => 'error', 'message' => 'Invalid request data'], Response::HTTP_BAD_REQUEST);
    }

    $user = new User();
    $user->setEmail($data['email']);
    $user->setPlainPassword($data['password']);

    // Hachage du mot de passe et assignation à l'utilisateur

    error_log('Before hashing: ' . $user->getPlainPassword());
    $hashedPassword = $passwordHasher->hashPassword($user, $user->getPlainPassword());
    $user->setPassword($hashedPassword);    
    error_log('After hashing: ' . $hashedPassword);

    // Validation de l'entité User
    $errors = $validator->validate($user);
    if (count($errors) > 0) {
        return $this->json(['status' => 'error', 'message' => (string) $errors], Response::HTTP_BAD_REQUEST);
    }





    $entityManager->persist($user);
    $entityManager->flush();

    return $this->json(['status' => 'success', 'message' => 'User registered successfully']);
}

}