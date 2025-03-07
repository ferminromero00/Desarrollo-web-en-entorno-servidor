<?php

namespace App\Controller;

use App\Entity\Caja;
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
        
        foreach ($caja as $a) {
            $e = ['id' => $a->getId(), 'fecha' => $a->getFecha(), 'cantidad' => $a->getCantidad()];
            array_push($arrayCaja, $e);
        }

        return $this->render('inicio/caja.html.twig', [
            'caja' => $arrayCaja
        ]);
    }
}
