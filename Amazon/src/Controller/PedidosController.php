<?php

namespace App\Controller;

use App\Entity\LineaPedido;
use App\Entity\Pedido;
use App\Form\FormLineaPedidoType;
use App\Form\FormPedidoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PedidosController extends AbstractController
{
    #[Route('/pedidos', name: 'app_pedidos')]
    public function index(): Response
    {
        return $this->render('pedidos/index.html.twig');
    }

    #[Route('/pedidos/nuevo', name: 'app_nuevo_pedido')]
    public function nuevoPedido(Request $request, EntityManagerInterface $em): Response
    {
        $pedido = new Pedido();
        $form = $this->createForm(FormPedidoType::class, $pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // asociamos el pedido con el usuario
            $pedido ->setCliente($this->getUser());
            // se graba el pedido
            $em->persist($pedido);
            $em->flush();

            return $this->addLineaPedido($pedido, $em, $request);
        }

        return $this->render('pedidos/nuevopedido.html.twig', [
            'form' => $form,
        ]);
    }

    public function addLineaPedido(Pedido $pedido, EntityManagerInterface $em, Request $request) {
        $lineaPedido = new LineaPedido();

        $form = $this->createForm(FormLineaPedidoType::class, $lineaPedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // asociamos el pedido
            $lineaPedido->setPedido($pedido);
            // grabamos la línea de pedido
            $em->persist($pedido);
            $em->flush();
        }

        return $this->render('pedidos/addLinea.html.twig', [
            'form' => $form,
            'pedido' => $pedido
        ]);
    }

    #[Route('/pedidos/{id}/ver', name: 'app_ver_pedido')]
    public function verPedido(Pedido $pedido): Response
    {
        dd($pedido);

        // return $this->render('pedidos/ver_pedido.html.twig');
    }
}
