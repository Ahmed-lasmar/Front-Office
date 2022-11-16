<?php

namespace App\Controller;

use App\Entity\Conge;
use App\Entity\Evenement;
use App\Entity\Formation;
use App\Entity\User;
use App\Form\CongeType;
use App\Form\DemConType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/emp')]
class EmpController extends AbstractController
{
    #[Route('/', name: 'app_emp')]
    public function index(): Response
    {
        return $this->render('emp/index.html.twig', [
            'controller_name' => 'EmpController',
        ]);
    }

    #[Route('/Formation', name: 'app_formation_emp', methods: ['GET'])]
    public function conFor(EntityManagerInterface $entityManager): Response
    {
        $formations = $entityManager
            ->getRepository(Formation::class)
            ->findAll();

        return $this->render('emp/conFor.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/Event', name: 'app_événements_emp', methods: ['GET'])]
    public function conEvent(EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('emp/conEvent.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/fichedepaie', name: 'app_fiche_de_paie_emp', methods: ['GET'])]
    public function conFdP(EntityManagerInterface $entityManager): Response
    {

        return $this->render('emp/conFdP.html.twig');
    }
    #[Route('/{iduser}/conge', name: 'app_conge_emp', methods: ['GET', 'POST'])]
    public function newCon(Request $request,User $user, EntityManagerInterface $entityManager): Response
    {
        $conge = new Conge();

        $form = $this->createForm(DemConType::class, $conge);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conge);
            $entityManager->flush();

            return $this->redirectToRoute('app_conge_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('emp/demCon.html.twig', [
            'conge' => $conge,
            'form' => $form,
        ]);
    }
}
