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

        # Se podría hacer con array_map
        /*
        $datos = array_map(function($articulo) {
            
            return
            [
                'nombre' => $articulo->getNombre(),                
                'precio' => $articulo->getPrecio(),                
            ];
        }, $articulos);
        return new JsonResponse(['articulos' => $datos], JsonResponse::HTTP_OK);
        */
        
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

        /*
        Si necesitamos las línea de artículo
       
        // Preparamos un arry donde ir gaurdando los objetos
        $datos = [];

        // Recorremos los pedidos
        foreach ($pedidos as $pedido) {
            // Obtenemos las líneas del pedido, pero como la consulta solo devuelve el pedido
            // tenemos que consultar las líneas que pertenecen al pedido
            // Tenemos que implementar en LineaPedidoRepository el método FindByPedido
            $lineas = $em->getRepository(LineaPedido::class)->FindByPedido($pedido->getId())
            
            // Creamos un array donde guardar las líneas del pedido
            $lineasJson = [];
            // Recorremos las liíneas del pedido
            foreach ($lineas as $linea) {
                // Generamos un array asociativo con los datos del pedido
                $lin = [
                    'id' => $linea->getId(),
                    'cantidad' => $linea->getCantidad(),
                    // Y dentro,
                    // otro array asociativo con los datos del producto
                    'producto' => [
                        'id' => $linea->getProducto()->getId(),
                        'nombre' => $linea->getProducto()->getNombre(),
                        'precio' => $linea->getProducto()->getPrecio()
                    ]
                ];
                // Añadimos el array de la línea al array de de las líneas
                array_push($lineasJson, $lin);
            }
            // Finalmente, creamos el pedido con sus datos
            $ped = [
                'id' => $pedido->getId(),
                'fecha' => $pedido->getFecha(),
                // Añadimos otro array con los datos del cliente
                'usuario' => [
                    'id' => $pedido->getCliente()->getId(),
                    'nombre' => $pedido->getCliente()->getNombre(),
                    
                ],
                // Añadimos las líneas creadas anteriormente
                'lineas' => $lineasJson
            ];
            // Guardamos el pedido en el array de pedidos
            array_push($datos, $ped);
        }
        // Lo enviamos con JSON
        return $this->json($datos);

        */
      
    }
    
    
}
