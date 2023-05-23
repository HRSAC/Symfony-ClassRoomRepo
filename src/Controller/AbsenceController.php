<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Form\AbsenceType;
use App\Repository\AbsenceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/absence')]
class AbsenceController extends AbstractController
{
    #[Route('/', name: 'app_absence_index', methods: ['GET'])]
    public function index(
        AbsenceRepository $absenceRepository,
        Request $request,
        PaginatorInterface $paginatorInterface
        ): Response{

            // Paginer les absence
        $absence = $paginatorInterface->paginate(
            $absenceRepository->findAll(), // Les données à paginer
            $request->query->getInt('page', 1), // Le numéro de la page courante
            5 // Le nombre d'éléments à afficher par page
        );

        return $this->render('absence/index.html.twig', [
            'absences' => $absence,
        ]);
    }

    #[Route('/new', name: 'app_absence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AbsenceRepository $absenceRepository): Response
    {
        $absence = new Absence();
        $form = $this->createForm(AbsenceType::class, $absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $absenceRepository->save($absence, true);

            $this->addFlash('success', 'Votre action a bien etait réaliser');

            return $this->redirectToRoute('app_absence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('absence/new.html.twig', [
            'absence' => $absence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_absence_show', methods: ['GET'])]
    public function show(Absence $absence): Response
    {
        return $this->render('absence/show.html.twig', [
            'absence' => $absence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_absence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Absence $absence, AbsenceRepository $absenceRepository): Response
    {
        $form = $this->createForm(AbsenceType::class, $absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $absenceRepository->save($absence, true);

            return $this->redirectToRoute('app_absence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('absence/edit.html.twig', [
            'absence' => $absence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_absence_delete', methods: ['POST'])]
    public function delete(Request $request, Absence $absence, AbsenceRepository $absenceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$absence->getId(), $request->request->get('_token'))) {
            $absenceRepository->remove($absence, true);
        }

        return $this->redirectToRoute('app_absence_index', [], Response::HTTP_SEE_OTHER);
    }
}
