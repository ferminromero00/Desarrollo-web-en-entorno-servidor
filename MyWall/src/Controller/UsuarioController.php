<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UsuarioController extends AbstractController
{
    #[Route('/muro', name: 'app_muro')]
    public function index(): Response
    {
        return $this->render('muro/index.html.twig', [
            'controller_name' => 'UsuarioController',
        ]);
    }
}
