<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserProfileTypeMDP;
use App\Form\UserProfileTypeInfoPerso;
use App\Form\UserProfileTypeMail;
use App\Repository\UserRepository;
use App\Repository\CoursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/profil/user')]
class ProfilUserController extends AbstractController
{
    #[Route('/', name: 'app_profil_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('profil_user/index.html.twig', [
            'user' => $this -> getUser(),
        ]);
    }


    #[Route('/{id}/editInfoPerso', name: 'app_profil_user_editInfoPerso', methods: ['GET', 'POST'])]
    public function editInfoPerso(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserProfileTypeInfoPerso::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_profil_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil_user/editInfoPerso.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/editMDP', name: 'app_profil_user_editMDP', methods: ['GET', 'POST'])]
    public function editMDP(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserProfileTypeMDP::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_profil_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil_user/editMDP.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    
    #[Route('/{id}/editMail', name: 'app_profil_user_editMail', methods: ['GET', 'POST'])]
    public function editMail(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserProfileTypeMail::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_profil_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil_user/editMail.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    //     return $this->redirectToRoute('app_profil_user_index', [], Response::HTTP_SEE_OTHER);
    // }




    

    #[Route('/profil', name: 'app_profil_calendar')]
    
    public function calendarProfil(CoursRepository $calendar): Response
    {

        $events = $calendar -> findAll();
        
        $rdvs = [];
        foreach($events as $event){
            $rdvs[] = [
                'id' => $event -> getId(),
                'start' => $event -> getHeureDebut()->format('Y-m-d H:i:s'),
                'end' => $event -> getHeureFin()->format('Y-m-d H:i:s'),
                'title' => $event -> getMatiere(),

            ];
        }

        $data = json_encode($rdvs);
        return $this->render('profil_user/index.html.twig', compact('data'));
    }
}
