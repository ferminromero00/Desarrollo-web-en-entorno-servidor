<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArbnbController extends AbstractController
{
    #[Route('/arbnb', name: 'app_arbnb')]
    public function index(): Response
    {
        return $this->render('arbnb/index.html.twig', [
            'titulo' => 'Bienvenido',
        ]);
    }

    #[Route('/arbnb/misalojamientos', name: 'app_mis_alojamientos')]
    public function misAlojamientos(): Response
    {
        return $this->render('arbnb/index.html.twig', [            
            'titulo' => 'Mis alojamientos',
        ]);
    }

    #[Route('/arbnb/misalojamientosalquilados', name: 'app_mis_alojamientos_alquilados')]
    public function misAlojamientosAlquilados(): Response
    {
        return $this->render('arbnb/index.html.twig', [            
            'titulo' => 'Mis alojamientos Alquilados',
        ]);
    }

    #[Route('/arbnb/alquilar', name: 'app_alquilar')]
    public function alquilar(): Response
    {
        return $this->render('arbnb/index.html.twig', [            
            'titulo' => 'Alquilar',
        ]);
    }

    
    #[Route('/arbnb/misalquileres', name: 'app_mis_alquileres')]
    public function misAlquileres(): Response
    {
        return $this->render('arbnb/index.html.twig', [            
            'titulo' => 'Mis alquileres',
        ]);
    }




}
