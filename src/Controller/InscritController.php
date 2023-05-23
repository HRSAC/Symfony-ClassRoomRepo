<?php

namespace App\Controller;

use App\Entity\Inscrit;
use App\Form\InscritType;
use App\Repository\InscritRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inscrit')]
class InscritController extends AbstractController
{
    #[Route('/', name: 'app_inscrit_index', methods: ['GET'])]
    public function index(InscritRepository $inscritRepository): Response
    {
        return $this->render('inscrit/index.html.twig', [
            'inscrits' => $inscritRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_inscrit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InscritRepository $inscritRepository): Response
    {
        $inscrit = new Inscrit();
        $form = $this->createForm(InscritType::class, $inscrit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscritRepository->save($inscrit, true);

            return $this->redirectToRoute('app_inscrit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscrit/new.html.twig', [
            'inscrit' => $inscrit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscrit_show', methods: ['GET'])]
    public function show(Inscrit $inscrit): Response
    {
        return $this->render('inscrit/show.html.twig', [
            'inscrit' => $inscrit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_inscrit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Inscrit $inscrit, InscritRepository $inscritRepository): Response
    {
        $form = $this->createForm(InscritType::class, $inscrit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscritRepository->save($inscrit, true);

            return $this->redirectToRoute('app_inscrit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscrit/edit.html.twig', [
            'inscrit' => $inscrit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_inscrit_delete', methods: ['POST'])]
    public function delete(Request $request, Inscrit $inscrit, InscritRepository $inscritRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscrit->getId(), $request->request->get('_token'))) {
            $inscritRepository->remove($inscrit, true);
        }

        return $this->redirectToRoute('app_inscrit_index', [], Response::HTTP_SEE_OTHER);
    }
}
