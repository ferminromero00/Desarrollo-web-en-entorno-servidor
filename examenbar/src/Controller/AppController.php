<?php

namespace App\Controller;

use App\Entity\Caja;
use App\Entity\Gasto;
use App\Entity\Proveedor;
use App\Form\CajaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;


class AppController extends AbstractController
{
    #[Route('/caja', name: 'app_caja')]
    public function caja(EntityManagerInterface $em): Response
    {
        $caja = $em->getRepository(Caja::class)->findAll();

        $arrayCaja = [];
        $total = 0;

        foreach ($caja as $a) {
            $e = ['id' => $a->getId(), 'fecha' => $a->getFecha(), 'cantidad' => $a->getCantidad()];
            $total += $a->getCantidad();
            array_push($arrayCaja, $e);
        }


        return $this->render('inicio/caja.html.twig', [
            'caja' => $arrayCaja,
            'total' => $total,
        ]);
    }
    #[Route('/caja/modificar/{CajaId}/edit', name: 'app_modificar_caja')]
    public function cajaModificar(EntityManagerInterface $em, int $CajaId): Response
    {
        $caja = $em->getRepository(Caja::class)->findBy(['id' => $CajaId]);
        return $this->render('inicio/modificarCaja.html.twig', [
            'caja' => $caja
        ]);
    }
    #[Route('/compras', name: 'app_compras')]
    public function compras(EntityManagerInterface $em): Response
    {
        $compras = $em->getRepository(Gasto::class)->findAll();
        $total = 0;
        $arrayCompras = [];

        foreach ($compras as $a) {
            $e = [
                'id' => $a->getId(),
                'fecha' => $a->getFecha(),
                'cantidad' => $a->getCantidad(),
                'proveedor' => $a->getProveedor(),
                'factura' => $a->isFactura()
            ];
            $total += $a->getCantidad();
            array_push($arrayCompras, $e);
        }
        return $this->render('inicio/compras.html.twig', [
            'compras' => $arrayCompras,
            'total' => $total
        ]);
    }
    #[Route('/compras/modificar/{CompraId}/edit', name: 'app_modificar_compra')]
    public function compraModificar(EntityManagerInterface $em, int $CompraId): Response
    {
        $compra = $em->getRepository(Gasto::class)->findBy(['id' => $CompraId]);

        $compras = $em->getRepository(Gasto::class)->findAll();
        $total = 0;
        $arrayCompras = [];

        foreach ($compras as $a) {
            $e = [
                'id' => $a->getId(), 
                'proveedor' => $a->getProveedor(),
            ];
            $total += $a->getCantidad();
            array_push($arrayCompras, $e);
        }

        return $this->render('inicio/modificarCompra.html.twig', [
            'compra' => $compra,
            'proveedores' => $arrayCompras
        ]);
    }
    #[Route('/proveedores', name: 'app_proveedores')]
    public function proveedores(EntityManagerInterface $em): Response
    {
        $compras = $em->getRepository(Proveedor::class)->findAll();
        $arrayProveedores = [];

        foreach ($compras as $a) {
            $e = [
                'id' => $a->getId(),
                'nombre' => $a->getNombre()
            ];
            array_push($arrayProveedores, $e);
        }
        return $this->render('inicio/proveedores.html.twig', [
            'proveedores' => $arrayProveedores,
        ]);
    }
    #[Route('/proveedores/modificar/{ProveedorId}/edit', name: 'app_modificar_proveedor')]
    public function proveedorModificar(EntityManagerInterface $em, int $ProveedorId): Response
    {
        $proveedor = $em->getRepository(Proveedor::class)->findBy(['id' => $ProveedorId]);
        return $this->render('inicio/modificarProveedor.html.twig', [
            'proveedor' => $proveedor
        ]);
    }
}
