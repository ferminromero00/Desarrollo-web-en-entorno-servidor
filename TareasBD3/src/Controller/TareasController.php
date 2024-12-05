<?php
// src/Controller/TareasController.php

namespace App\Controller;

use App\Entity\Tarea;
use App\Form\TareaFormularioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TareasController extends AbstractController
{
    #[Route('/tareas', name: 'app_tareas')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tarea = new Tarea();
        $form = $this->createForm(TareaFormularioType::class, $tarea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tarea->setUsuario($this->getUser()); //pasamos el id del usuario directamente
            $entityManager->persist($tarea);
            $entityManager->flush();
            return $this->redirectToRoute('app_tareas');
        }

        //$tareas = $entityManager->getRepository(Tarea::class)->findAll();

        return $this->render('tareas/index.html.twig', [
            'form' => $form,
            //'tareas' => $tareas,
        ]);
    }

    #[Route('/tareas/edit/{id}', name: 'tareas_edit')]
    public function edit(Request $request, Tarea $tarea, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TareaFormularioType::class, $tarea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tareas');
        }

        return $this->render('tareas/edit.html.twig', [
            'form' => $form->createView(),
            'tarea' => $tarea,
        ]);
    }

    #[Route('/tareas/delete/{id}', name: 'tareas_delete')]
    public function delete(Tarea $tarea, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($tarea);
        $entityManager->flush();

        return $this->redirectToRoute('app_tareas');
    }
}