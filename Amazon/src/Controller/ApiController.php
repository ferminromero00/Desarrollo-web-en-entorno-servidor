<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Articulo;

class ApiController extends AbstractController
{
    #[Route('/api/articulos', name: 'app_api_articulos')]
    public function articulos(EntityManagerInterface $em): JsonResponse
    {
        // Leemos los art´ciulos de la base de datos
        $articulos = $em->getRepository(Articulo::class)->findAll();

        // datos será un array de arrays
        // A la vieja usanza
        
        /*
        $datos = [];
        foreach ($articulos as $a) {
            // convierto cada entidad artículo en un array
            $linea = ['id' => $a->getId(), 'nombre' => $a->getNombre(), 'precio' => $a->getPrecio()];
            // Y lo añado a datos
            array_push($datos, $linea);
        }
        */

        $datos = array_map(function ($articulo) {
            return [
                'id' => $articulo->getId(),
                'nombre' => $articulo->getNombre(),
                'precio' => $articulo->getPrecio(),                
            ];
        }, $articulos);

        return $this->json($datos);


    }
}
