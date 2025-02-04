<?php

namespace App\Controller;

use App\Entity\Articulo;
use App\Form\ArticulosType;
use App\Repository\ArticuloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticulosController extends AbstractController
{
    #[Route('/articulos', name: 'app_articulos')]
    public function index(ArticuloRepository $articuloRepository, Request $request): Response
    {
        $articulo = new Articulo();
        $form = $this->createForm(ArticulosType::class, $articulo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articuloRepository->add($articulo);
            return $this->redirectToRoute('app_articulos');
        }

        return $this->render('articulos/index.html.twig', [
            'articulos' => $articuloRepository->findAll(),
            'form' => $form->createView()
        ]);
    }
}
