<?php

namespace App\Controller;

use App\Entity\Publicacion;
use App\Form\PublicacionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyWallController extends AbstractController
{
    #[Route('/muro', name: 'app_muro')]
    public function muro(Request $request, EntityManagerInterface $entityManager): Response
    {
        $publicacion = new Publicacion();
        $form = $this->createForm(PublicacionType::class, $publicacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $publicacion->setUsuario($this->getUser());
            $publicacion->setFechaCreacion(new \DateTimeImmutable());
            $entityManager->persist($publicacion);
            $entityManager->flush();

            return $this->redirectToRoute('app_muro');
        }

        // Obtener las publicaciones ordenadas por fecha de creación
        $publicaciones = $entityManager->getRepository(Publicacion::class)->findBy([], ['fechaCreacion' => 'DESC']);

        return $this->render('muro/index.html.twig', [
            'form' => $form->createView(),
            'publicaciones' => $publicaciones, // Enviar publicaciones a la vista
        ]);
    }

    #[Route('/publicar', name: 'app_publicar', methods: ['POST'])]
    public function publicar(Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $contenido = $request->request->get('contenido');

        if ($contenido) {
            $publicacion = new Publicacion();
            $publicacion->setUsuario($this->getUser());
            $publicacion->setContenido($contenido);
            $publicacion->setFechaCreacion(new \DateTimeImmutable());

            $entityManager->persist($publicacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_muro');
    }

}

