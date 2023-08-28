<?php

namespace App\Controller;

use Error;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        
        // afficher notre tableau Todo
        // sinon je l'initialise puis l'afficher

        if (! $session->has (name: 'todos')) {
            $todos =[
                'achat' => 'acheter clé USB',
                'cours' => 'finilaser mon cours',
                'correction' => 'corriger mes examens'
            ];

            $session->set('todos', $todos);
            return $this->addFlash( type: 'info', message: "La liste de todo viens d'etre initialisée ");
        }

        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }

    #[Route('/todo/{name}/{content}', name: 'todo.add' )]

    public function addTodo(Request $request, $name, $content){

        
        $session = $request->getSession();
        
        //verifier si j ai mon tableau dans session
        if ($session->has (name: 'todos')){
            $todos = $session->get( name: 'todos');
            if (isset($todos [$name])){
                $this->addFlash( type: 'error', message: "La todo d'id $name est dèja dans la liste ");
            }else{
                $todos[$name] = $content;
                // sinon on l'ajoute et afficher un message succés    
                $this->addFlash( type: 'success', message: "La todo d'id $name a été ajouté avec succès");

                $session->set( 'todos', $todos);
            }
        }
      
        //sinon 
        // afficher une erreur et rediriger vers le controller index 

        $this->addFlash( type: 'error', message: "La liste des todo n'est pas encore initialisée ");
        
               return $this->redirectToRoute( route: '/todo');
    }
}
