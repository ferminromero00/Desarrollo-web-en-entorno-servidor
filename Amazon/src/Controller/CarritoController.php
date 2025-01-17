<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Articulo;
use App\Entity\Pedido;
use App\Entity\LineaPedido;
use App\Entity\Cliente;

class CarritoController extends AbstractController
{
    #[Route('/carrito', name: 'app_carrito')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {

        // Creamos un pedido vacío
        $pedido = new Pedido();
        // Guardamos el pedido en la sesión
        $sesion = $request->getSession()->set('pedido', $pedido);
        // Obtenemos todos los artículos de la base de datos        
        $articulos = $em->getRepository(Articulo::class)->findAll();

        // Renderizamos la página pasándole los artículos y el pedido
        return $this->render('carrito/index.html.twig', [
            'articulos' => $articulos,
            'pedido' => $pedido
        ]);
    }

    #[Route('/carrito/addnuevoarticulo/{id}', name: 'app_carrito_addnuevoarticulo')]
    public function addnuevoarticulo(Articulo $articulo, EntityManagerInterface $em, Request $request): Response
    {
        
        // Creamos una nueva línea de pedido
        $linea = new LineaPedido();
        // Establecemos la cantidad
        $linea->setCantidad(1);
        // Establecemos el artículo
        $linea->setArticulo($articulo);
        // Recuperamos el pedido de la sesión
        $pedido = $request->getSession()->get('pedido');
        // Añadimos la línea al pedido 
        $pedido->addLineaPedido($linea);
        
        // Obtenemos todos los artículos de la base de datos
        $articulos = $em->getRepository(Articulo::class)->findAll();
        // Volvemos al index
        return $this->render('carrito/index.html.twig', [
            'articulos' => $articulos,
            'pedido' => $pedido
        ]);
    }

    #[Route('/carrito/vaciarcesta', name: 'app_vaciar_cesta')]
    public function vaciarCesta(EntityManagerInterface $em, Request $request): Response
    {
        // Creamos un nuevo pedido vacio
        $pedido = new Pedido();
        // Sustituimos en la sesión el pedido actual por el pedido vacio
        $request->getSession()->set('pedido', $pedido);
        // Recogemos de la base de datos todos los artículos
        $articulos = $em->getRepository(Articulo::class)->findAll();
        // Renderizamos la página pasándole los artículo y el nuevo pedido
        return $this->render('carrito/index.html.twig', [
            'articulos' => $articulos,
            'pedido' => $pedido
        ]);
    }

    #[Route('/carrito/finalizarpedido', name: 'app_finalizar_pedido')]
    public function finalizarPedido(EntityManagerInterface $em, Request $request): Response
    {
        // Para tramitar el pedido necesitamos los datos del cliente
        // Si no hay cliente registrado
        if (!$this->getUser()) {
            // Mostramos el formulario de identificación
            // ¿ Dónde debemos ir después de identificarnos ? --> volvemos a finalizar pedido
            return $this->redirectToRoute('app_login');
        }

        // Mostrar un resumen del pedido en una nueva página
        // Desde esa página podremos llamar a un mçétodo del 
        // controlador para poder grabar definitivamente el pedido
    }
}

/*
// Recuperamos el pedido de la sesión
$pedido = $request->getSession()->get('pedido');
// Estableced la fecha
$fecha = new \DateTime();
$pedido->setFecha($fecha);
// Estableced el cliente
$cliente = $em->getRepository(Cliente::class)->find(1);
$pedido->setCliente($cliente);
// Si no existe abrimos el formulario de autenticación
// Después de la autenticación volvemos a grabar el pedido
// Recorremos cada línea de pedido
$lineas = $pedido->getLineaPedidos();        
foreach ($lineas as $linea) {
    // Y Persisitimos cada una de las líneas
    $articulo = $linea->getArticulo();
    $em->detach($articulo);
    $em->persist($linea);
    $em->detach($articulo);
}
// Persistimos el pedido
$em->persist($pedido);
// Grabamos todo
$em->flush();
return $this->render('carrito/resumen.html.twig', [
    'pedido' => $pedido
]);
*/