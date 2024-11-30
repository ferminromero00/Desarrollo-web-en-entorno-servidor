<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Pedido;

class PedidosController extends AbstractController
{
    #[Route('/pedidos', name: 'app_pedidos')]
    public function index(): Response
    {
        return $this->render('pedidos/index.html.twig', [
            'titulo' => 'Pedidos',

        ]);

    }

    #[Route('/pedidos/{id}/ver', name: 'app_ver_pedido')]
    public function VerPedido(Pedido $pedido): Response
    {
        dd($pedido);
    }

}
