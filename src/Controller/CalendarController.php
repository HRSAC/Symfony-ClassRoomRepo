<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalendarController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    
    public function index(CoursRepository $calendar ): Response
    {
        
        $events = $calendar -> findAll();
        
        $rdvs = [];
        foreach($events as $event){
            $rdvs[] = [
                'id' => $event -> getId(),
                'title' => $event -> getMatiere(),
                'date' => $event -> getDate()->format('Y-m-d'),
                'timeStart' => date_create($event -> getDate()->format('Y-m-d').
                $event -> getHeureDebut()->format('H:i:s')),
                'timeEnd' => date_create($event -> getDate()->format('Y-m-d').
                $event -> getHeureFin()->format('H:i:s')),
                

            ];
        }

        $data = json_encode($rdvs);
        return $this->render('pages/security/Accueil.html.twig', compact('data'));
    }







}
