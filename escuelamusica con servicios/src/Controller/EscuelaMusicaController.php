<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Instrumento;
use App\Entity\Usuario;
use App\Entity\Matricula;
use App\Form\FormImpartirInstrumentoType;
use App\Form\FormInstrumentoType;


class EscuelaMusicaController extends AbstractController
{
    #[Route('/escuela/musica', name: 'app_escuela_musica_index')]
    public function index(): Response
    {
        if ($this->getUser()->isProfesor()) {
            return $this->redirectToRoute('app_profesores');
        } else {
            return $this->redirectToRoute('app_alumno');
        }

    }

    #[Route('/escuela/musica/profesores', name: 'app_profesores')]
    public function profesores(Request $request, EntityManagerInterface $em, SessionInterface $session): Response
    {
        $user = $this->getUser();
        $instrumentosImpartidos = $user->getInstrumentos();
        $instrumentosNoImpartidos = $em->getRepository(Instrumento::class)->findNoImpartidosPorProfesor($user->getId());

        $instrumentosAñadidos = $request->getSession()->get('instrumentoAñadidos', []);

        return $this->render('escuela_musica/profesor.html.twig', [
            'instrumentosImpartidos' => $instrumentosImpartidos,
            'instrumentosNoImpartidos' => $instrumentosNoImpartidos,
            'instrumentosAñadidos' => $instrumentosAñadidos
        ]);
    }

    #[Route('/escuela/musica/añadir/{instrumentoId}', name: 'app_añadir_instrumento')]
    public function añadirInstrumento(int $instrumentoId, SessionInterface $session, EntityManagerInterface $em): Response
    {
        $instrumento = $em->getRepository(Instrumento::class)->find($instrumentoId);

        $instrumentosAñadidos = $session->get('instrumentoAñadidos', []);

        $instrumentosAñadidos[] = $instrumento;
        $session->set('instrumentoAñadidos', $instrumentosAñadidos);

        return $this->redirectToRoute('app_profesores');
    }

    #[Route('/escuela/musica/grabar', name: 'app_grabar_instrumento')]
    public function grabarInstrumentos(Request $request, EntityManagerInterface $em, SessionInterface $session): Response
    {
        $instrumentosAñadidos = $request->getSession()->get('instrumentoAñadidos', []);
        $user = $this->getUser();

        foreach ($instrumentosAñadidos as $instrumento) {
            $instrumentoEntity = $em->getRepository(Instrumento::class)->find($instrumento->getId());

            if ($instrumentoEntity) {
                $instrumentoEntity->setProfesor($user);
                $em->persist($instrumentoEntity);
            }
        }

        $em->flush();
        $session->remove('instrumentoAñadidos');
        $this->addFlash('success', 'Intrumentos añadidos con exito');

        return $this->redirectToRoute('app_profesores');

    }

    #[Route('/escuela/musica/eliminar', name: 'app_eliminar_instrumento')]
    public function eliminarInstrumentos(Request $request, EntityManagerInterface $em, SessionInterface $session): Response
    {
        $session->remove('instrumentoAñadidos');
        $this->addFlash('success', 'Intrumentos eliminados con exito');
        return $this->redirectToRoute('app_profesores');

    }


    #[Route('/escuela/musica/alumno', name: 'app_alumno')]
    public function alumno(Request $request, EntityManagerInterface $em, SessionInterface $session): Response
    {
        $user = $this->getUser();
        $matriculas = $em->getRepository(Matricula::class)->findBy(['alumno' => $user]);
        $instrumentosNoMatriculados = $em->getRepository(Instrumento::class)->findNoMatriculadoPorAlumno($user);
        $matriculasAñadidas = $session->get('matriculas', []);

        return $this->render('escuela_musica/alumno.html.twig', [
            'matriculas' => $matriculas,
            'instrumentosNoMatriculados' => $instrumentosNoMatriculados,
            'matriculasAñadidas' => $matriculasAñadidas
        ]);
    }


}
