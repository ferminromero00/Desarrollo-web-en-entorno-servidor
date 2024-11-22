<?php
// src/Controller/UsuarioController.php

namespace App\Controller;

use App\Form\EditarCuentaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    #[Route('/mi-cuenta/editar', name: 'mi_cuenta_editar')]
    public function editar(Request $request, EntityManagerInterface $entityManager): Response
    {
        $usuario = $this->getUser();

        $form = $this->createForm(EditarCuentaType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($usuario); // Asegúrate de persistir el usuario
            $entityManager->flush();

            return $this->redirectToRoute('app_tareas');
        }

        return $this->render('usuario/editar.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}