<?php

namespace App\Controller;

use App\Entity\Images;
use App\Form\ImagesType;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ImagesController extends AbstractController
{

    const SERVER_PATH_TO_IMAGE_FOLDER = './images';

    #[Route('/images', name: 'app_images')]
    public function index(ImagesRepository $imagesRepository, Request $request): Response
    {
        $image = new Images();
        $form = $this->createForm(ImagesType::class, $image);
        $form->handleRequest($request);  // Esto faltaba

        if ($form->isSubmitted() && $form->isValid()) {
            $resultImg = $form->get('nombre')->getData();

            if ($resultImg) {
                $userId = $this->getUser()->getId();
                $currentDateTime = new \DateTime();
                $extension = $resultImg->getClientOriginalExtension();

                $filename = $userId . '-' . $currentDateTime->format('Y-m-d-H-i-s') . '.' . $extension;

                // Mover el archivo
                $resultImg->move($this::SERVER_PATH_TO_IMAGE_FOLDER, $filename);

                // Guardar el nombre del archivo en la entidad
                $image->setNombre($filename);

                $imagesRepository->add($image);  // Cambié persist y flush por save

                return $this->redirectToRoute('app_images');
            }
        }

        return $this->render('images/index.html.twig', [
            'imageForm' => $form,
            'imageList' => $imagesRepository->findAll()
        ]);
    }
}
