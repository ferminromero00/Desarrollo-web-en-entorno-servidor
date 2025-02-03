<?php

namespace App\Controller;

use App\Entity\Publicacion;
use App\Entity\Comentario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ApiPostController extends AbstractController
{
    #[Route('/api/publicaciones', name: 'api_publicaciones', methods: ['GET'])]
    public function getPublicaciones(EntityManagerInterface $entityManager): Response
    {
        $publicaciones = $entityManager->getRepository(Publicacion::class)->findBy([], ['fechaCreacion' => 'DESC']);
        
        $data = array_map(function ($publicacion) {
            return [
                'id' => $publicacion->getId(),
                'contenido' => $publicacion->getContenido(),
                'usuario' => $publicacion->getUsuario()->getUsername(),
                'fecha' => $publicacion->getFechaCreacion()->format('Y-m-d H:i:s'),
            ];
        }, $publicaciones);

        return $this->json($data);
    }

    #[Route('/api/publicaciones', name: 'api_crear_publicacion', methods: ['POST'])]
    public function createPublicacion(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $contenido = $data['contenido'];

        $publicacion = new Publicacion();
        $publicacion->setContenido($contenido);
        $publicacion->setUsuario($this->getUser());  // El usuario está autenticado por JWT
        $publicacion->setFechaCreacion(new \DateTimeImmutable());

        $entityManager->persist($publicacion);
        $entityManager->flush();

        return $this->json(['message' => 'Publicación creada'], Response::HTTP_CREATED);
    }

    #[Route('/api/publicacion/{id}/comentar', name: 'api_comentar_publicacion', methods: ['POST'])]
    public function comentar(Request $request, Publicacion $publicacion, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        $contenido = $data['contenido'];

        $comentario = new Comentario();
        $comentario->setPublicacion($publicacion);
        $comentario->setUsuario($this->getUser());
        $comentario->setContenido($contenido);
        $comentario->setFechaCreacion(new \DateTimeImmutable());

        $entityManager->persist($comentario);
        $entityManager->flush();

        return $this->json(['message' => 'Comentario creado'], Response::HTTP_CREATED);
    }
}
