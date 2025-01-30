<?php

namespace App\Controller;

use App\Entity\Comentario;
use App\Entity\Publicacion;
use App\Form\ComentarioType;
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

    #[Route('/publicacion/{id}/eliminar', name: 'app_eliminar_publicacion', methods: ['POST'])]
    public function eliminarPublicacion($id, EntityManagerInterface $entityManager): Response
    {
        // Buscar la publicación por su ID
        $publicacion = $entityManager->getRepository(Publicacion::class)->find($id);

        // Verificar si la publicación existe y si pertenece al usuario
        if ($publicacion && $publicacion->getUsuario() === $this->getUser()) {
            // Eliminar la publicación
            $entityManager->remove($publicacion);
            $entityManager->flush();
        }

        // Redirigir de nuevo al muro
        return $this->redirectToRoute('app_muro');
    }

    #[Route('/publicacion/{id}/comentar', name: 'app_comentar_publicacion', methods: ['POST'])]
    public function comentar(Publicacion $publicacion, Request $request, EntityManagerInterface $entityManager): Response
    {
        $comentario = new Comentario();
        $comentario->setPublicacion($publicacion);
        $comentario->setUsuario($this->getUser());
        $comentario->setFechaCreacion(new \DateTimeImmutable());

        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comentario);
            $entityManager->flush();

            return $this->redirectToRoute('app_muro');
        }

        return $this->render('muro/comentar.html.twig', [
            'form' => $form->createView(),
            'publicacion' => $publicacion,
        ]);
    }

}

