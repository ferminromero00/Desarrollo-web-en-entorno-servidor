<?php

namespace App\Controller;

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

    #[Route('/public/saludo', name: 'app_api_saludo')]
    public function saludo(EntityManagerInterface $em, Request $request): Response
    {
        # un servicio simple
        return new JsonResponse(['saludo' => 'hola']);
    }

    #[Route('/public/articulos', name: 'app_api_articulos')]
    public function articulos(EntityManagerInterface $em, Request $request): JsonResponse
    {
        # leemos todos los artículos de la base de datos
        $articulos = $em->getRepository(Articulo::class)->findAll();

        # Creamos un array vacío
        $arrayArt = [];

        # Recorremos el array
        foreach ($articulos as $a) {
            # Creamos otro array con los datos del artículo
            $tupla = ['id' => $a->getId(), 'nombre' => $a->getNombre(), 'precio' => $a->getPrecio()];
            # Lo añadimos al primer array
            array_push($arrayArt, $tupla);
        }

        # Conbvertimos el array de arrays en un json
        return new JsonResponse(['articulos' => $arrayArt], JsonResponse::HTTP_OK);
        
    }

    #[Route('/api/pedidos', name: 'app_api_jsonpedidos', methods:['GET', 'POST'])]
    public function pedidos(EntityManagerInterface $em, Request $request, Security $security): JsonResponse
    {
        # Extraemos el cliente a partir de la decodificación del token
        $cliente = $security->getUser();

        # Obtenemos los pedidos del cliente
        $pedidos = $em->getRepository(Pedido::class)->findByField('cliente', $cliente->getId());
        $datos = array_map(function($pedido) {
            return
            [
                'id' => $pedido->getId(),
                'fecha' => $pedido->getFecha()
            ];
        }, $pedidos);

        return new JsonResponse($datos);
      
    }
    
    
}
