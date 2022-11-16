<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Entity\Evaluation;
use App\Form\EntretienType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/entretien')]
class EntretienController extends AbstractController
{
    #[Route('/', name: 'app_entretien_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $entretiens = $entityManager
            ->getRepository(Entretien::class)
            ->findAll();
        $evaluation = $entityManager
            ->getRepository(Evaluation::class)
            ->findAll();

        return $this->render('entretien/index.html.twig', [
            'entretiens' => $entretiens,
            'evaluations' => $evaluation,
        ]);
    }

    #[Route('/new', name: 'app_entretien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $entretien = new Entretien();
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($entretien);
            $entityManager->flush();

            return $this->redirectToRoute('app_entretien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entretien/new.html.twig', [
            'entretien' => $entretien,
            'form' => $form,
        ]);
    }

    #[Route('/{idEntretien}', name: 'app_entretien_show', methods: ['GET'])]
    public function show(Entretien $entretien): Response
    {
        return $this->render('entretien/show.html.twig', [
            'entretien' => $entretien,
        ]);
    }

    #[Route('/{idEntretien}/edit', name: 'app_entretien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entretien $entretien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_entretien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entretien/edit.html.twig', [
            'entretien' => $entretien,
            'form' => $form,
        ]);
    }

    #[Route('/{idEntretien}', name: 'app_entretien_delete', methods: ['POST'])]
    public function delete(Request $request, Entretien $entretien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entretien->getIdEntretien(), $request->request->get('_token'))) {
            $entityManager->remove($entretien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_entretien_index', [], Response::HTTP_SEE_OTHER);
    }
}
