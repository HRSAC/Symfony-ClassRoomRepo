<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class SecurityController extends AbstractController
{

    #[Route(path: '/connexion', name: 'security.login', methods:['POST', 'GET'])]
    public function login() : Response
    {


        return $this->render('pages/security/index.html.twig', ['controller_name' => 'SecurityController']);
    }

    #[Route(path: '/deconnexion', name: 'security.logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    public function registration(Request $request, EntityManagerInterface $manager): Response
        {
            $user = new User();
            $form = $this->createForm(RegistrationType::class, $user);

            $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
                $user = $form->getData();

                $this->addFlash(
                    'success',
                    'votre compte a bien été créé'
                );

                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('security.login');
            }

            return $this->render('pages/security/index.html.twig', [
                'form' => $form->createView()
            ]);
        }
    

}
