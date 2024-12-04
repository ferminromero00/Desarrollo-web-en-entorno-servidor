<?php

namespace App\Controller;

use App\Entity\Alojamiento;
use App\Entity\Alquiler;
use App\Form\FormAlojamientoType;
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
    public function misAlojamientos(Request $request, EntityManagerInterface $em): Response
    {
        $alojamiento = new Alojamiento();
        $form = $this->createForm(FormAlojamientoType::class, $alojamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $alojamiento->setPropietario($this->getUser());
            $em->persist($alojamiento);
            $em->flush();
        }

        return $this->render('arbnb/misalojamientos.html.twig', [
            'titulo' => 'Mis alojamientos',
            'form' => $form,
        ]);
    }

    #[Route('/arbnb/alquilar', name: 'app_alquilar')]
    public function alquilar(EntityManagerInterface $em): Response
    {
        //Leemos todas las tablas
        $casas = $em->getRepository(Alojamiento::class)->findAll();


        return $this->render('arbnb/alquilar.html.twig', [
            'titulo' => 'Alquilar',
            'casas' => $casas,
        ]);
    }

    #[Route('/arbnb/realizaralquiler/{id}', name: 'app_realizar_alquiler')]
    public function realizaralquiler(Alojamiento $alojamiento, EntityManagerInterface $em): Response
    {
        $alquiler = new Alquiler();
        $alquiler->setCliente($this->getUser());
        $alquiler->setAlojamiento($alojamiento);
        $em->persist($alquiler);
        $em->flush();


        return $this->render('arbnb/realizaralquiler.html.twig', [
            'titulo' => 'Alquilar Alojamientos',
            'alquiler' => $alquiler,
        ]);
    }






    #[Route('/arbnb/misalojamientosalquilados', name: 'app_mis_alojamientos_alquilados')]
    public function misAlojamientosAlquilados(): Response
    {
        return $this->render('arbnb/index.html.twig', [
            'titulo' => 'Mis alojamientos Alquilados',
        ]);
    }




    #[Route('/arbnb/misalquileres', name: 'app_mis_alquileres')]
    public function misAlquileres(): Response
    {
        return $this->render('arbnb/realizaralquiler.html.twig', [
            'titulo' => 'Mis alquileres',
        ]);
    }


    #[Route('/arbnb/alquileresalojamiento/{id}', name: 'app_alquileres_del_alojamiento')]
    public function alquileresAlojamiento(Alojamiento $alojamiento): Response
    {
        return $this->render('arbnb/veralquileresAlojamiento.html.twig', [
            'titulo' => 'Alquileres del Alojamiento',
            'alojamiento' => $alojamiento,
        ]);
    }





}
