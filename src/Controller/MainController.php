<?php

namespace App\Controller;

use App\Entity\Offreemploi;
use App\Repository\ImagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
    #[Route('/mainrrh', name: 'app_main_rrh')]
    public function mainrrh(): Response
    {
        return $this->render('main/rrh.html.twig');
    }

    #[Route('/mainemp', name: 'app_main_emp')]
    public function mainemp(): Response
    {
        return $this->render('main/Femp.html.twig');
    }

    #[Route('/maincan', name: 'app_main_can')]
    public function maincan(ImagesRepository $imagesRepository,EntityManagerInterface $entityManager): Response
    {
        $list=$imagesRepository->findAll();
        $lists=$entityManager->getRepository(Offreemploi::class)->findAll();
        return $this->render('main/Can.html.twig',['list'=>$list,"lists"=>$lists]);
    }

    #[Route('/db', name: 'app_db')]
    public function db(): Response
    {
        return $this->render('DBbase.html.twig');
    }
    #[Route('/portfolioDetails/{idOffre}', name: 'app_details')]
    public function details($idOffre,ImagesRepository $imagesRepository): Response
    {
        $Offre=$imagesRepository->findByOffre($idOffre);
        return $this->render('main/portfolio-details.html.twig',['offre'=>$Offre]);
    }
}
