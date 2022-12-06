<?php

namespace App\Controller;

use App\Entity\Conge;
use App\Entity\Evenement;
use App\Entity\Formation;
use App\Entity\User;
use App\Form\CongeType;
use App\Form\DemConType;
use App\Repository\EmpRepository;
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
    #[Route('/conge', name: 'app_conge_emp', methods: ['GET', 'POST'])]
    public function newCon(Request $request,EntityManagerInterface $entityManager): Response
    {
        $conge = new Conge();

        $form = $this->createForm(DemConType::class, $conge);
        $form->handleRequest($request);
        $conge->setIdper($request->get('iduser'));
        $conge->setEtatdemande("en cour de traitement");

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conge);
            $entityManager->flush();

            return $this->redirectToRoute('app_emp', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('emp/demCon.html.twig', [
            'conge' => $conge,
            'form' => $form,
        ]);
    }

    #[Route('/myConge', name: 'my_conge_emp', methods: ['GET'])]
    public function myConge(Request $request,EmpRepository $rep): Response
    {
        $conges = $rep->findByCongeByPer($request->get('iduser'));
        //$conges = $rep->findByCongeByPer('2');

        return $this->render('emp/zmpMyConge.html.twig', [
            'conges' => $conges,
        ]);
    }
}
