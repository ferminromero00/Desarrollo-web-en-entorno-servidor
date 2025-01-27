<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpClient\HttpClient;


class ClienteController extends AbstractController
{
    #[Route('/cliente/get', name: 'app_cliente_get')]
    public function get(): Response
    {
        // Crea un cliente HTTP
        $client = HttpClient::create();

        // Ejemplo de una solicitud GET
        $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        
        // Obtener el contenido de la respuesta
        $content = $response->getContent();
        
        // Convertir la respuesta en JSON (si es que lo es)
        $data = json_decode($content, true);
        
        // Mostrar los primeros 5 posts
        $posts = array_slice($data, 0, 5);

        return $this->json($posts);
    }

    #[Route('/cliente/post', name: 'app_cliente_post')]
    public function post(): Response
    {
        // Crear un cliente HTTP
        $client = HttpClient::create();

        // Enviar datos a un microservicio usando POST
        $response = $client->request('POST', 'https://jsonplaceholder.typicode.com/posts', [
            'json' => [
                'title' => 'foo',
                'body' => 'bar',
                'userId' => 1,
            ],
        ]);
        
        // Obtener la respuesta
        $content = $response->getContent();
        
        // Mostrar la respuesta del servidor
        return $this->json(json_decode($content, true));
    }
}


