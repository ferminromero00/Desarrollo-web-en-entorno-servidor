<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PublicacionController extends AbstractController
{
    #[Route('/publicacion', name: 'app_publicacion')]
    public function index(): Response
    {
        return $this->render('publicacion/index.html.twig', [
            'controller_name' => 'PublicacionController',
        ]);
    }
}
