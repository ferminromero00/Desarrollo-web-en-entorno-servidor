<?php

namespace App\Controller;

use App\Entity\TareasSymfony;
use App\Form\TareasSymfonyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TareasSymfonyController extends AbstractController
{
    #[Route('/tareas/symfony', name: 'app_tareas_symfony')]
    public function index(Request $request): Response
    {
        //Creamos un objeto TareasSymfony vacio
        $tarea = new TareasSymfony();

        //Crear el formulario en objeto del clase TareasSymfonyController
        //Le pasamos el objeto tarea para que lo rellene
        $formulario = $this->createForm(TareasSymfonyType::class, $tarea, [
            'method' => 'GET'
        ]);

        //Recogemos el formulario
        $formulario->handleRequest($request);

        //Comprobamos que el formulario ha sido enviado y que es valido
        if ($formulario->isSubmitted() && $formulario->isValid()) {
            //Recogemos los datos a traves de objeto

            $boton = $formulario->getClickedButton()->getName();
            if ($boton == "Guardar") {
                $tarea = $formulario->getData();
                $this->guardarTarea($tarea, $request);
            } else {
                $this->eliminarTareas($request);
            }
        }

        //Le pasamos el formulario como un parametro, Pasamos titulo, tarea como parametos y renderizamos la vista
        return $this->render('tareas_symfony/index.html.twig', [
            //'controller_name' => 'TareasSymfonyController',
            'titulo' => 'Hola Mundo',

            //Pasamos el formulario a la pagina como parametro
            'formulario' => $formulario,

            //le pasamos la tarea, osea los datos que hemos enviado
            'tarea' => $tarea,

            //Y pasamos e array de tareas guardado en la sesion
            'tareas' => $request->getSession()->get('tareas')
        ]);
    }

    public function guardarTarea(TareasSymfony $tarea, Request $request)
    {
        $sesion = $request->getSession();
        // Attempt to get the array of tasks, or an empty array if it doesn't exist
        $tareas = $sesion->get('tareas', []);

        // Save the task in the tasks array
        array_push($tareas, $tarea);

        // Finally, save the tasks array in the session
        $sesion->set('tareas', $tareas);
    }

    public function eliminarTareas(Request $request)
    {
        $request->getSession()->set("tareas", []);


    }

}
