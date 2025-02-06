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
use App\Form\FormInstrumentoType;


class EscuelaMusicaController extends AbstractController
{
    #[Route('/escuela/musica', name: 'app_escuela_musica_index')]
    public function index(): Response
    {
        if ($this->getUser()->isProfesor()) {
            return $this->redirectToRoute('app_profesores');
        }else{
            return $this->redirectToRoute('app_alumno');        }
        
    }

    

    #[Route('/escuela/musica/profesores', name: 'app_profesores')]
    public function profesores(Request $request, EntityManagerInterface $em): Response
    {
       
        return $this->render('escuela_musica/profesor.html.twig', [
            
        ]);
    }

    #[Route('/escuela/musica/alumno', name: 'app_alumno')]
    public function alumno(Request $request, EntityManagerInterface $em): Response
    {
        return $this->render('escuela_musica/alumno.html.twig', [
        ]);
    }

  
}
