<?php

namespace App\Controller;

use App\Entity\LineaPedido;
use App\Entity\Pedido;
use App\Form\FormLineaPedidoType;
use App\Form\FormPedidoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
class PedidosController extends AbstractController
{
    #[Route('/pedidos', name: 'app_pedidos')]
    public function index(): Response
    {
        return $this->render('pedidos/index.html.twig', [
            'titulo' => 'Pedidos',
        ]);
    }


    #[Route('/pedidos/ver/{id}', name: 'app_ver_pedidos')]
    public function verPedido(Pedido $pedido): Response
    {
        dd($pedido);
    }

    #[Route('/pedidos/nuevo', name: 'app_nuevo_pedido')]
    public function pedidoNuevo(Request $request, EntityManagerInterface $em): Response
    {
        $pedido = new Pedido();
        $form = $this->createForm(FormPedidoType::class, $pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pedido->setCliente($this->getUser());
            // Grabamos el pedido
            $em->persist($pedido);
            $em->flush();

            // Redirigimos a la página donde añadir las líneas
            return $this->redirectToRoute('app_add_linea_pedido', ['id' => $pedido->getId()]);
        }

        return $this->render("pedidos/nuevopedido.html.twig", [
            'form' => $form,
        ]);
    }


    #[Route('/pedidos/{id}/add-linea', name: 'app_add_linea_pedido')]
    public function addLineaPedido(Pedido $pedido, Request $request, EntityManagerInterface $em): Response
    {
        $lineaPedido = new LineaPedido();
        $formLineaPedido = $this->createForm(FormLineaPedidoType::class, $lineaPedido);
        $formLineaPedido->handleRequest($request);

        if ($formLineaPedido->isSubmitted() && $formLineaPedido->isValid()) {
            $lineaPedido->setPedido($pedido);
            $em->persist($lineaPedido);
            $em->flush();

            // Redirigir a la vista del pedido o a otra página
            return $this->redirectToRoute('app_pedidos', ['id' => $pedido->getId()]);
        }

        return $this->render("pedidos/addLinea.html.twig", [
            'pedido' => $pedido,
            'form' => $formLineaPedido->createView(),
        ]);
    }

}