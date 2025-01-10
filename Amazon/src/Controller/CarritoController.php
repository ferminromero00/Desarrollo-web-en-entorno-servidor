<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Entity\Pedido;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarritoController extends AbstractController
{
    #[Route('/carrito', name: 'app_carrito')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        //Obtenemos todos los articulos
        $articulos = $em->getRepository(Articulo::class)->findAll();
        //Creamos un pedido
        $pedido = new Pedido();
        //Guardamos pedido en la sesion
        $sesion = $request->getSession()->set('pedido', $pedido);

        return $this->render('carrito/index.html.twig', [
            'articulos' => $articulos
        ]);
    }

    
}
