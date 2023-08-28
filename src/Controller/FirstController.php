<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FirstController extends AbstractController
{
    #[Route('/first/{name}/{last_name}', name: 'app_first')]
    public function index(Request $request, $name, $last_name): Response
    {
       
        return $this->render('first/index.html.twig', [
           'nom' => $name,
           'prenom' => $last_name,
        ]);
    }
    

}  

 

