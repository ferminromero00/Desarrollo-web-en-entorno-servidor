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
        // Establecemos el artículo, no está mapeado en la tabla
        $linea->setArticulo($articulo);
        $linea->setArticuloId($articulo->getId());
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
        // Recuperamos el pedido de la sesión por si esta pendiente de grabar
        $pedido = $request->getSession()->get('pedido');
        # Si existe un pedido pendiente y no está vacío
        if ($pedido && !$pedido->getLineaPedidos()->isEmpty()) {
            // Asociamos el cliente al pedido
            $pedido->setCliente($this->getUser());
            # $pedido->setClienteId($this->getUser()->getId());
            // Le damos una fecha provisional al pedido
            $pedido->setFecha(new \DateTime());
            // Guardamos el pedido en la sesión
            $request->getSession()->set('pedido', $pedido);
            // Mostramos una página de resumen del pedido
            return $this->render('carrito/resumen.html.twig', [
                'pedido' => $pedido
            ]);
        }else{
            # Si no hay pedido vamos a ver mis pedidos
            return $this->redirectToRoute('app_mispedidos');
        }

    }

    #[Route('/carrito/grabarpedido', name: 'app_grabar_pedido')]
    public function grabarPedido(EntityManagerInterface $em, Request $request): Response
    {

        // Recuperamos el pedido de la sesión
        $pedido = $request->getSession()->get('pedido');
        /* Persistimos el pedido para que Doctrine sepa que tiene que actualizar 
        (insertar, borrar o modificar) el pedido en la base de datos */
        $lineas = $pedido->getLineaPedidos();
        foreach ($lineas as $linea) {            
            $em->persist($linea);            
            
        }
        // Añadimos el pedido al cliente
        $this->getUser()->addPedido($pedido);
        // Persistimos el pedido        
        $em->persist($pedido);
        // Dejamos para el final a la entidad más fuerte
        $em->persist($this->getUser());
        // Le decimos a Doctrine que efectue los cambios en la base de datos
        $em->flush();
        $this->addFlash('mensaje','El pedido se ha grabado correctamente');
        // Eliminar el pedido de la sesión
        $request->getSession()->remove('pedido');
        return $this->render('carrito/resumen.html.twig', [
            'pedido' => $pedido
        ]);


    }

    #[Route('/carrito/mispedidos', name: 'app_mispedidos')]
    public function misPedidos(EntityManagerInterface $em, Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login', [
                'redireccion' =>'app_mispedidos'
            ]);
        }

        $pedidos = $em->getRepository(Pedido::class)->findByField('cliente', $this->getUser()->getId());
        return $this->render('carrito/mispedidos.html.twig', [
            'pedidos' => $pedidos

        ]);

    }

    #[Route('/carrito/detallepedido/{id}', name: 'app_detalle_pedido')]
    public function detallePedido(Pedido $pedido, EntityManagerInterface $em, Request $request): Response
    {
        // dd($pedido);
        $lineas = $em->getRepository(LineaPedido::class)->findByField('pedido', $pedido->getId());
        foreach ($lineas as $l) {
            $articulo = $em->getRepository(Articulo::class)->find($l->getArticuloId());
            $l->setArticulo($articulo);
            $pedido->addLineaPedido($l);
        }

        return $this->render('carrito/detallepedido.html.twig', [
            'pedido' => $pedido
        ]);
    }

    #[Route('/carrito/eliminarlinea/{pedido}/{linea}', name: 'app_eliminar_linea')]
    public function eliminarLinea(Pedido $pedido, LineaPedido $linea, EntityManagerInterface $em, Request $request): Response
    //public function eliminarLinea(int $pedido, int $linea, EntityManagerInterface $em, Request $request): Response
    {
        // Vuelvo a leer las líneas del pedido   
        $lineas = $em->getRepository(LineaPedido::class)->findByField('pedido', $pedido->getId());
        foreach ($lineas as $l) {
            // Y para cada línea leo de la base de datos el artículo
            $articulo = $em->getRepository(Articulo::class)->find($l->getArticuloId());
            // Se lo asocio a la línea
            $l->setArticulo($articulo);
            // Y le añado la línea al pedido
            $pedido->addLineaPedido($l);
        }
        
        // Borrar la línea de pedido de la base de datos
        $em->remove($linea);
        $em->flush();
        // Borrar la línea de pedido de la la colección de líneas de pedido del pedido
        $pedido->removeLineaPedido($linea);
        
        return $this->render('carrito/detallepedido.html.twig', [
            'pedido' => $pedido
        ]);
    }






}

