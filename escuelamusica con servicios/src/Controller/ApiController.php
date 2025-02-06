<?php

namespace App\Controller;

use App\Entity\Instrumento;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
//use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\SecurityBundle\Security;



use App\Entity\Articulo;
use App\Entity\Pedido;


final class ApiController extends AbstractController
{
    #[Route('/public/instrumentos', name: 'app_api_instrumentos')]
    public function articulos(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $instrumentos = $em->getRepository(Instrumento::class)->findAll();

        $instrumentosArray = [];

        foreach ($instrumentos as $instrumento) {
            $instrumentosArray[] = [
                'id' => $instrumento->getId(),
                'nombre' => $instrumento->getNombre(),
            ];
        }

        return new JsonResponse([$instrumentosArray]);
    }


}
