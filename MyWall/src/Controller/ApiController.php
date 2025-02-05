<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class ApiController extends AbstractController
{
    #[Route('/api/hello', name: 'api_hello', methods: ['GET'])]
    public function hello(Security $security): JsonResponse
    {
        // Obtenemos al usuario autenticado a partir del token JWT
        $user = $security->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'No autenticado'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse(['message' => 'Hola, ' . $user->getUsername()], JsonResponse::HTTP_OK);
    }
}
