<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Entity\LineaPedido;
use App\Entity\Pedido;
use App\Repository\ArticuloRepository;
use App\Repository\LineaPedidoRepository;
use App\Repository\PedidoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarritoController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[Route('/carrito/add/{id}', name: 'app_carrito_add')]
    public function addToCarrito(Articulo $articulo)
    {
        $session = $this->requestStack->getSession();
        $carrito = $session->get('carrito', []);

        if (!array_key_exists($articulo->getId(), $carrito)) {
            $carrito[$articulo->getId()] = 1;
        } else {
            $carrito[$articulo->getId()]++;
        }

        $session->set('carrito', $carrito);

        return $this->redirectToRoute('app_articulos');
    }

    #[Route('/carrito/addOneItem/{id}', name: 'app_carrito_add_one')]
    public function addOneItem(Articulo $articulo)
    {
        $session = $this->requestStack->getSession();
        $carrito = $session->get('carrito', []);

        if (!array_key_exists($articulo->getId(), $carrito)) {
            $carrito[$articulo->getId()] = 1;
        } else {
            $carrito[$articulo->getId()]++;
        }

        $session->set('carrito', $carrito);

        return $this->redirectToRoute('app_carrito');
    }

    #[Route('/carrito/removeOneItem/{id}', name: 'app_carrito_remove_one')]
    public function removeFromCarrito(Articulo $articulo)
    {
        $session = $this->requestStack->getSession();
        $carrito = $session->get('carrito', []);

        if (array_key_exists($articulo->getId(), $carrito)) {
            if ($carrito[$articulo->getId()] > 1) {
                $carrito[$articulo->getId()]--;
            } else {
                unset($carrito[$articulo->getId()]);
            }
        }

        $session->set('carrito', $carrito);

        return $this->redirectToRoute('app_carrito');
    }

    #[Route('/carrito/remove/{id}', name: 'app_carrito_remove')]
    public function removeArticulo(Articulo $articulo)
    {
        $session = $this->requestStack->getSession();
        $carrito = $session->get('carrito', []);

        if (array_key_exists($articulo->getId(), $carrito)) {
            unset($carrito[$articulo->getId()]);
        }

        $session->set('carrito', $carrito);

        return $this->redirectToRoute('app_carrito');
    }

    #[Route('/carrito/clear', name: 'app_carrito_clear')]
    public function clearCarrito()
    {
        $session = $this->requestStack->getSession();
        $session->set('carrito', []);

        return $this->redirectToRoute('app_carrito');
    }

    #[Route('/carrito', name: 'app_carrito')]
    public function index(ArticuloRepository $articuloRepository): Response
    {
        $session = $this->requestStack->getSession();
        $carrito = $session->get('carrito', []);

        $articulos = [];
        $totalPrecio = 0;
        foreach ($carrito as $id => $cantidad) {
            $articulo = $articuloRepository->find($id);
            $articulos[] = (object) [
                'id' => $id,
                'cantidad' => $cantidad,
                'articulo' => $articulo
            ];
            if ($articulo) {
                $totalPrecio += $articulo->getPrecio() * $cantidad;
            }
        }

        return $this->render('carrito/index.html.twig', [
            'articulos' => $articulos,
            'totalPrecio' => $totalPrecio
        ]);
    }

    #[Route('/carrito/process', name: 'app_carrito_process')]
    public function processOrder(
        ArticuloRepository $articuloRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $session = $this->requestStack->getSession();
        $carrito = $session->get('carrito', []);

        // Crear y guardar pedido
        $pedido = new Pedido();
        $pedido->setUsuario($this->getUser());
        $entityManager->persist($pedido);

        // Crear líneas de pedido
        foreach ($carrito as $articuloId => $cantidad) {
            $articulo = $articuloRepository->find($articuloId);

            $lineaPedido = new LineaPedido();
            $lineaPedido->setArticulo($articulo);
            $lineaPedido->setCantidad($cantidad);
            $lineaPedido->setPedido($pedido);

            $entityManager->persist($lineaPedido);
        }

        $entityManager->flush();
        $session->set('carrito', []);
        return $this->redirectToRoute('app_carrito');
    }
}
