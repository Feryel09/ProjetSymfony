<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClubController extends AbstractController
{
    #[Route('/club/{name}', name: 'app_club')]
    public function afficheN($name )
    {
        return $this->render('club/afficheN.html.twig', [
            'name'=>$name
        ]);
    }
    #[Route('/liste', name:'list_formation')]
    public function liste()
    {
         $formations = array(
            array('id' => 1, 'Titre' => 'FORM Symfony', 'description'=>'formation theorique', 'Nb_participants'=>'19'),
            array('id' => 2, 'Titre' => 'math', 'description'=>'formation theorique', 'Nb_participants'=>'23'),
            array('id' => 3, 'Titre' => 'info', 'description'=>'formation pratique', 'Nb_participants'=>'0'),
        ); 
        return $this->render('club/liste.html.twig', ['formation'=>$formations]);
    }

}
