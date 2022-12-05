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
        $name=$entityManager ->getRepository(Entretien::class)->findAll();
        $note=$entityManager ->getRepository(Evaluation::class)->findAll();
        $categFname = [];
        $categName = [];
        $categNote = [];

        foreach($firstName as $fn ){
            $categFname[] = $fn->getFirstnameCandidat();
        }
        foreach($name as $nom ){
            $categName[] = $nom->getNameCandidat();
        }
        foreach($note as $n ){
            $categNote[] = $n->getNote();
        }




        return $this->render('home/stat.html.twig',['nom'=>json_encode($categName) ,'prenom'=>json_encode($categFname), 'note'=>json_encode($categNote)]
        );
}}