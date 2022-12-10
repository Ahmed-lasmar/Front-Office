<?php

namespace App\Controller;

use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontEvnController extends AbstractController
{
    #[Route('/front/evn', name: 'app_front_evn')]
    public function index(): Response
    {
        return $this->render('front_evn/index.html.twig', [
            'controller_name' => 'FrontEvnController',
        ]);
    }

    #[Route('/aff', name: 'afff', methods: ['GET'])]
    public function indexx(EntityManagerInterface $entityManager): Response
    {
        $evenements = $entityManager
            ->getRepository(Evenement::class)
            ->findAll();

        return $this->render('front_evn/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    /**
     * @Route("/homeclient", name="home_client")
     */
    public function inde(Request  $request, PaginatorInterface $paginator): Response
    {

        $Evenements=$this->getDoctrine()->getManager()->getRepository(Evenement::class)->findAll();


        //PAGINATION BUNDLE
        $Evenements = $paginator->paginate(
        // Doctrine Query, not results
            $Evenements,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            2


        );





        return $this->render('front_evn/index.html.twig', [
            'evenements'=>$Evenements
        ]);


    }



}
