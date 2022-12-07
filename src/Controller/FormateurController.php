<?php

namespace App\Controller;
use App\Entity\Formateur;

use App\Entity\Formation;
use App\Form\FormateurType;
use App\Form\FormationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/formateur')]
class FormateurController extends AbstractController
{
    #[Route('/', name: 'app_formateur_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $formateurs = $entityManager
            ->getRepository(Formateur::class)
            ->findAll();

        return $this->render('formateur/index.html.twig', [
            'formateur' => $formateurs,
        ]);
    }

    /**
     * @Route("/triid", name="triid")
     */

    public function Triid(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT f FROM App\Entity\Formateur f 
            ORDER BY f.nom'
        );


        $formateurs = $query->getResult();

        return $this->render('formateur/index.html.twig',
            array('formateur' => $formateurs));

    }


    #[Route('/new', name: 'app_formateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formateur = new Formateur();
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_formateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formateur/new.html.twig', [
            'formateur' => $formateur,
            'form' => $form,
        ]);
    }
    #[Route('/{idFormateur}', name: 'app_formateur_show', methods: ['GET'])]
    public function show(Formateur $formateur): Response
    {
        return $this->render('formateur/show.html.twig', [
            'formateur' => $formateur,
        ]);
    }
    #[Route('/{idFormateur}/edit', name: 'app_formateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formateur $formateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_formateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formateur/edit.html.twig', [
            'formateur' => $formateur,
            'form' => $form,
        ]);
    }
    #[Route('/{idFormateur}', name: 'app_formateur_delete', methods: ['POST'])]
    public function delete(Request $request, Formateur $formateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formateur->getIdFormateur(), $request->request->get('_token'))) {
            $entityManager->remove($formateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_formateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
