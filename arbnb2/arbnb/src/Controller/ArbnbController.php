<?php

namespace App\Controller;

use App\Entity\Alojamiento;
use App\Entity\Alquiler;
use App\Form\HacerAlquilerType;
use App\Repository\AlojamientoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        return $this->render('arbnb/misalojamientos.html.twig', [
            'titulo' => 'Bienvenido a tus Alojamientos: ',
        ]);
    }

    #[Route('/arbnb/misalojamientosalquilados', name: 'app_mis_alojamientos_alquilados')]
    public function misAlojamientosAlquilados(): Response
    {
        return $this->render('arbnb/verAlquilados.html.twig', [
            'titulo' => 'Personas alquiladas en los alojamientos de: ',
        ]);
    }

    #[Route('/arbnb/alquilar', name: 'app_alquilar')]
    public function alquilar(EntityManagerInterface $e): Response
    {
        $alojamientos = $e->getRepository(Alojamiento::class)->findAll();


        return $this->render('arbnb/alquilar.html.twig', [
            'titulo' => '¿Quieres alquilar?: ',
            'alojamientos' => $alojamientos,
        ]);
    }


    #[Route('/arbnb/misalquileres', name: 'app_mis_alquileres')]
    public function misAlquileres(): Response
    {

        return $this->render('arbnb/veralquileres.html.twig', [
            'titulo' => 'Tus alquileres: ',
        ]);
    }

    #[Route('/arbnb/nuevo/{id}', name: 'app_añadir_alquileres')]
    public function insertarAlquiler(Alojamiento $alojamiento, EntityManagerInterface $e): Response
    {
        $alquiler = new Alquiler();
        $alquiler->setCliente($this->getUser());
        $alquiler->setAlojamiento($alojamiento);

        $e->persist($alquiler);
        $e->flush();


        return $this->render('arbnb/misalquileres.html.twig', [
            'titulo' => 'Tus alquileres: ',
            'alquiler' => $alquiler,
        ]);
    }





}
