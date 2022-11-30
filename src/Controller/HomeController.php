<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Entity\Evaluation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class HomeController  extends AbstractController
{
    #[Route('/chart', name: 'app_homepage')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $firstName=$entityManager ->getRepository(Entretien::class)->findAll();
        $note=$entityManager ->getRepository(Evaluation::class)->findAll();
        $categNom = [];
        $categNote = [];

        foreach($firstName as $fn ){
            $categNom[] = $fn->getFirstnameCandidat();
        }
        foreach($note as $n ){
            $categNote[] = $n->getNote();
        }




        return $this->render('home/stat.html.twig',['nom'=>json_encode($categNom) , 'note'=>json_encode($categNote)]
        );
}}