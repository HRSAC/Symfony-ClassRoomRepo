<?php

namespace App\Controller;

use App\Entity\Cours;
use App\classe\Search;
use App\Repository\CoursRepository;
use App\Repository\AbsenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatistiquesController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){

        $this->entityManager = $entityManager;
    }

    // #[Route('/statistiques', name: 'app_statistiques')]
    // public function index(): Response
    // {
    //     // $cours = $this->entityManager->getRepository(Cours::class)->findAll();

    //     // $search = new Search();
    //     // $form = $this->createForm();
    //     return $this->render('statistiques/stat.html.twig', [
    //         // 'controller_name' => 'StatistiquesController',
    //         // 'form' => $form->createView()
    //     ]);
    // }



    #[Route('/statistiques', name: 'app_statistiques')]
    public function statistique(CoursRepository $coursRepo, AbsenceRepository $absenceRepo): Response{
        //on va chercher tous les cours
        $cours = $coursRepo->findAll();
        $absences = $absenceRepo->findAll();
        
        $coursMatiere =[];
        // $coursCount = [];
        foreach ($cours as $cour) {
            $coursMatiere[] = $cour->getMatiere();
            // $coursCount[] = count($cour->$coursMatiere[]);

        };

        $absences = array();
        foreach ($absences as $absences) {

            $absences[] = $absences -> getPeut_id();
        };

        return $this->render('statistiques/stat.html.twig', [
            'coursMatiere'=> json_encode($coursMatiere),
            'absences'=> json_encode($absences),
            // 'coursCount' => json_encode($coursCount),
            
        ]);
    }

    /**
     * Get the value of entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Set the value of entityManager
     */
    public function setEntityManager($entityManager): self
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
