<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;


final class ClienteController extends AbstractController
{

    #[Route('/cliente/articulos', name: 'app_cliente_articulos')]
    public function articulos(HttpClientInterface $httpClient): Response
    {
        $response = $httpClient->request('GET', 'http://127.0.0.1:8000/public/articulos'); 

        dd($response->getContent());
        
    }

  

    #[Route('/cliente/login', name: 'app_cliente_login')]
    public function login(HttpClientInterface $httpClient, Request $request): Response
    {
        # Obtenemos el username y el password pasados como parámetros en la url al cliente
        $username = $request->query->get('username');
        $password = $request->query->get('password');

        # Lanzamos la petición proporcionando el username y el password
        $response = $httpClient->request('POST', 'http://localhost:8000/api/login', [
            'json' => [
                'username' => $username,
                'password' => $password
            ]
        ]);
        # Decodificamos la respuesta para obtener el token
        $json = json_decode($response->getContent(),true);
        # Guardamos el token en la sesión
        $request->getSession()->set('token', $json['token']);
        # Devolvemos, también, el token como respuesta al navegador
        return new Response($json['token']);
            
    }


    #[Route('/cliente/pedidos', name: 'app_cliente_pedidos')]
    public function jsonpedidos(HttpClientInterface $httpClient, Request $request): Response
    {
        # Nos identificamos previamente para que obtener el token (a través de la sesión o de la respuesta)
        $response = $this->login($httpClient, $request);        
        # Recuperamnos el token a a través de la respuesta
        $jwtToken = $response->getContent();
        # También podríamos obtenerlo de la sesión si lo hemnos guardado en $this->login()
        # $jwtToken = $request->getSession()->get('token');

        # Lanzamos la petición proporcionando el login
        $respuesta = $httpClient->request('POST', 'http://localhost:8000/api/pedidos', [
            'headers' => [
                'Authorization' => "Bearer $jwtToken",
                'Accept' => 'application/json',
            ]]);

        # Devolvemos el la respuesta
        return new Response($respuesta->getContent());

    } 
}
