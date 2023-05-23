<?php

namespace App\Controller;

use DateTime;
use App\Entity\Cours;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    // #[Route('/api', name: 'app_api')]
    // public function index(): Response
    // {
    //     return $this->render('api/index.html.twig', [
    //         'controller_name' => 'ApiController',
    //     ]);
    // }

    #[Route('/api/{id}/edit', name: 'app_api_event_eddit', methods : ['PUT'])]
    public function MajEvent(?Cours $cours, Request $request, ManagerRegistry $doctrine): Response
    {
        // on recupere les données
        $donnees = json_decode($request->getContent());
        if(
            isset($donnees->id) && !empty($donnees->id) &&
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->end) &&
            isset($donnees->date) && !empty($donnees->date)
        ){
            //Les données sont complètes
            $code = 200;

            //On verifie si l'id existe
            if (!$cours) {
                //on instance un cours 
                $cours = new Cours;

                //on change le code
                $code = 201;
            }

            //on hydrate l'objet avec nos données
            $cours->getId();
            $cours->setMatiere($donnees->title);
            $cours->setdate(new DateTime($donnees->date));
            $cours->setHeureDebut(date_create($donnees->start));
            $cours->setHeureFin(date_create($donnees->end));
            
            
            

            $em = $doctrine->getManager();
            $em->persist($cours);
            $em->flush();

            //on retourne le code
            return new Response('Ok', $code);

        }else {
            //Les données sont incomplètes
            return new Response ('Données incomplètes', 404);
        }

        // return $this->render('api/index.html.twig', [
        //     'controller_name' => 'ApiController',
        // ]);
    }
}
