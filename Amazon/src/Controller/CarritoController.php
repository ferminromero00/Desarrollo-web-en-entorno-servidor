<?php

namespace App\Controller;

use App\Entity\Articulo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarritoController extends AbstractController
{
    #[Route('/carrito', name: 'app_carrito')]
    public function index(EntityManagerInterface $em): Response
    {
        $articulos = $em->getRepository(Articulo::class)->findAll();

        return $this->render('carrito/index.html.twig', [
            'articulos' => $articulos
        ]);
    }
}
