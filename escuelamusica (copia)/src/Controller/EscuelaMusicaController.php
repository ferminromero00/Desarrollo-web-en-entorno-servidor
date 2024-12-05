<?php

namespace App\Controller;

use App\Form\FerminAnadirInstrumentoMatriculaType;
use App\Form\FerminAñadirInstrumentoType;
use App\Form\FerminNuevoInstrumentoType;
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
    public function profesor(Request $request, EntityManagerInterface $e): Response
    {

        $instrumento = new Instrumento();
        $form = $this->createForm(FerminNuevoInstrumentoType::class, $instrumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $instrumento->setProfesor($this->getUser());
            $e->persist($instrumento);
            $e->flush();
            return $this->redirectToRoute('app_profesor');
        }


        return $this->render('escuelamusica/FerminListaProfesor.html.twig', [
            'titulo' => 'Listado de tus instrumentos: ',
            'form' => $form
        ]);
    }

    #[Route('/escuela/musica/alumno', name: 'app_alumno')]
    public function alumno(Request $request, EntityManagerInterface $e): Response
    {

        $instrumento = $e->getRepository(Instrumento::class)->findAll();


        return $this->render('escuelamusica/listaFerminRomero.html.twig', [
            'titulo' => 'Listado de tus matriculas: ',
            'instrumento' => $instrumento,
        ]);
    }




    #[Route('/escuela/musica/alumnos', name: 'app_alumnos')]
    public function alumnado(EntityManagerInterface $e): Response
    {

        $alums = $e->getRepository(Usuario::class)->findAll();





        return $this->render('escuelamusica/FerminVerAlumnos.html.twig', [
            'titulo' => 'Ver alumnos escuela: ',
            'alumnos' => $alums
        ]);
    }



    #[Route('/escuela/musica/instrumento', name: 'app_instrumentos')]
    public function instrumentos(Request $request, EntityManagerInterface $em): Response
    {
        // Por poner algo
        return $this->render('escuelamusica/index.html.twig');
    }

    #[Route('/escuela/musica/listado', name: 'app_instrumentos')]
    public function listado(EntityManagerInterface $e): Response
    {
        $instrumento = $e->getRepository(Instrumento::class)->findAll();

        return $this->render('escuelamusica/listaFerminRomero.html.twig', [
            'titulo' => 'Listado de tus matriculas: ',
            'instrumento' => $instrumento,
        ]);
    }

    #[Route('/escuela/musica/listado1', name: 'app_instrumentos1')]
    public function listado1(EntityManagerInterface $e, Request $request): Response
    {
        $instrumento = new Instrumento();
        $form = $this->createForm(FerminNuevoInstrumentoType::class, $instrumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $e->persist($instrumento);
            $e->flush();
            return $this->redirectToRoute('app_instrumentos1');
        }

        $instrumento = $e->getRepository(Instrumento::class)->findAll();

        return $this->render('escuelamusica/FerminVerTodosIntru.html.twig', [
            'titulo' => 'Listado de tus matriculas: ',
            'formulario' => $form,
            'instrumento' => $instrumento,
        ]);
    }



    #[Route('/escuela/musica/matriculados/{id}', name: 'app_ver_matriculados')]
    public function vermatriculados(EntityManagerInterface $e, int $id): Response
    {

        $instrumento = $e->getRepository(Instrumento::class)->find($id);
        $matriculas = $instrumento->getMatriculas();


        return $this->render('escuelamusica/FerminRomeroVerMatriculados.html.twig', [
            'titulo' => 'Listado de tus matriculas: ',
            'matriculas' => $matriculas
        ]);
    }

    #[Route('/escuela/musica/añadir', name: 'app_añadir_instrumento')]
    public function añadirInstrumento(Request $request, EntityManagerInterface $e): Response
    {
        $instrumento = new Instrumento();
        $form = $this->createForm(FerminNuevoInstrumentoType::class, $instrumento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $instrumento->setProfesor($this->getUser());
            $e->persist($instrumento);
            $e->flush();
            return $this->redirectToRoute('app_instrumentos1');
        }


        return $this->render('escuelamusica/FerminAñadirInst.html.twig', [
            'titulo' => 'Añade tu instrumento para dar clases: ',
            'form' => $form
        ]);
    }


    #[Route('/escuela/musica/verMatricula/{id}', name: 'app_ver_matricula_alumno')]
    public function instrumentosMatriculado(EntityManagerInterface $e, int $id, Request $request): Response
    {
        $user = $e->getRepository(Usuario::class)->find($id);
        $matriculado = $user->getMatricula();

        $alumno = $e->getRepository(Usuario::class)->find($id);


        $matricula = new Matricula();
        $form = $this->createForm(FerminAnadirInstrumentoMatriculaType::class, $matricula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matricula->setAlumno($alumno);
            $e->persist($matricula);
            $e->flush();
            return $this->redirectToRoute('app_alumnos');
        }

        return $this->render('escuelamusica/FerminverMatricula.html.twig', [
            'titulo' => 'Instrumentos matriculados',
            'ins' => $matriculado,
            'form' => $form
        ]);
    }

    #[Route('/escuela/musica/AñadirIntrumento/{id}', name: 'app_añadir_instrumento_matriculado')]
    public function añadirIntrumentoMatricula(Request $request, EntityManagerInterface $e, int $id): Response
    {
        $alumno = $e->getRepository(Usuario::class)->find($id);


        $matricula = new Matricula();
        $form = $this->createForm(FerminAnadirInstrumentoMatriculaType::class, $matricula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matricula->setAlumno($alumno);
            $e->persist($matricula);
            $e->flush();
            return $this->redirectToRoute('app_profesor');
        }

        return $this->render('escuelamusica/FerminAñadirIntrumento.html.twig', [
            'titulo' => 'Añadir instrumento',
            'form' => $form
        ]);
    }





}
