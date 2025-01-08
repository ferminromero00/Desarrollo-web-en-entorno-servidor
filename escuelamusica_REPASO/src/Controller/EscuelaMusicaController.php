<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Instrumento;
use App\Entity\Usuario;
use App\Entity\Matricula;
use App\Form\FormImpartirInstrumentoType;


class EscuelaMusicaController extends AbstractController
{
    #[Route('/escuela/musica', name: 'app_escuela_musica_index')]
    public function index(): Response
    {
        if ($this->getUser()->isProfesor()) {
            return $this->redirectToRoute('app_profesor');
        } else {

            return $this->redirectToRoute('app_alumno');
        }

    }

    #[Route('/escuela/musica/profesor', name: 'app_profesor')]
    public function profesor(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(FormImpartirInstrumentoType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }
    

        return $this->render('escuelamusica/misclases.html.twig', [
            'form' => $form
        ]);

    }

    #[Route('/escuela/musica/alumno', name: 'app_alumno')]
    public function alumno(Request $request, EntityManagerInterface $em): Response
    {
        // Por poner algo
        return $this->render('escuelamusica/alumnado.html.twig', [
            'alumno' => $this->getUser()
        ]);
    }

    #[Route('/escuela/musica/alumnos', name: 'app_alumnos')]
    public function alumnado(Request $request, EntityManagerInterface $em): Response
    {
        // Por poner algo
        return $this->render('escuelamusica/index.html.twig');
    }

    #[Route('/escuela/musica/alumnos/{id}', name: 'app_ver_alumnado_matriculado')]
    public function alumnado_matriculado(Request $request, EntityManagerInterface $em, Instrumento $instrumento): Response
    {
        return $this->render('escuelamusica/alumnadoMatriculado.html.twig', [
            'instrumento' => $instrumento
        ]);
    }

    #[Route('/escuela/musica/instrumento', name: 'app_instrumentos')]
    public function instrumentos(Request $request, EntityManagerInterface $em): Response
    {
        // Por poner algo
        return $this->render('escuelamusica/index.html.twig');
    }


}
