<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Entity\LineaPedido;
use App\Entity\Pedido;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarritoController extends AbstractController
{
    #[Route('/articulos', name: 'app_carrito')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        //Obtenemos todos los articulos
        $articulos = $em->getRepository(Articulo::class)->findAll();
        //Creamos un pedido
        $pedido = new Pedido();
        //Guardamos pedido en la sesion
        $sesion = $request->getSession()->set('pedido', $pedido);

        return $this->render('carrito/index.html.twig', [
            'articulos' => $articulos,
            'pedido' => $pedido
        ]);
    }

    #[Route('/carrito/nuevoarticulo/{id}', name: 'app_carrito_nuevoarticulo')]
    public function addnuevoarticulo(EntityManagerInterface $em, Request $request, Articulo $articulo): Response
    {
        //Recuperamos el pedido
        $pedido = $request->getSession()->get('pedido');
        //Creamos nueva linea
        $linea = new LineaPedido();
        //Establecemos cantidad
        $linea->setCantidad(1);
        //Establecemos articulo
        $linea->setArticulo($articulo);
        //Añadimosla linea al pedido
        $pedido->addLineaPedidos($linea);

        return $this->render('carrito/nuevoarticulo.html.twig', [
            'articulos' => $articulo,
            
        ]);
    }


}
