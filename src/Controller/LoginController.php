<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('pages/security/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
