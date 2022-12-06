<?php

namespace App\Controller;

use App\Entity\Offreemploi;
use App\Entity\Rate;
use App\Repository\ImagesRepository;
use App\Repository\RateRepository;
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
    public function maincan(ImagesRepository $imagesRepository,EntityManagerInterface $entityManager,RateRepository $rateRepository): Response
    {
        $list=$imagesRepository->findAll();
        $lists=$rateRepository->topRatedOffer();


        return $this->render('main/Can.html.twig',['list'=>$list,'lists'=>$lists]);
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
    #[Route('/portfolioDetails/{idOffre}/like', name: 'app_like_offer',  methods: ['GET', 'POST'])]
    public function likeOffer(EntityManagerInterface $entityManager,$idOffre,ImagesRepository $imagesRepository,RateRepository $rateRepository): Response
    {
        $lists=$rateRepository->topRatedOffer();
        $list=$imagesRepository->findAll();
        $offre=$imagesRepository->findByOffre($idOffre);
        foreach($offre as $img){
            $rating=new Rate();
            $rating->setRating("like");
            $img->getOffreemploi()->addRating($rating);
           $rateRepository->add($rating,true);
            $entityManager->persist($rating);
            $entityManager->flush();
            // On stocke l'image dans la base de données (son nom)
            // $rating->setRating("like");
            //$offreemploi->addRating($rating);
        }

        return $this->render('main/portfolio-details.html.twig',['offre'=>$offre,'lists'=>$lists]);
    }
    #[Route('/portfolioDetails/{idOffre}/dislike', name: 'app_dislike_offer',  methods: ['GET', 'POST'])]
    public function dislikeOffer(EntityManagerInterface $entityManager,$idOffre,ImagesRepository $imagesRepository,RateRepository $rateRepository): Response
    {
        $list=$imagesRepository->findAll();
        $lists=$rateRepository->topRatedOffer();
        $offre=$imagesRepository->findByOffre($idOffre);
        foreach($offre as $img){
            $rating=new Rate();
            $rating->setRating("dislike");
            $img->getOffreemploi()->addRating($rating);
            $rateRepository->add($rating,true);
            $entityManager->persist($rating);
            $entityManager->flush();
            // On stocke l'image dans la base de données (son nom)
            // $rating->setRating("like");
            //$offreemploi->addRating($rating);
        }

        return $this->render('main/portfolio-details.html.twig',['offre'=>$offre,'lists'=>$lists]);
    }
}
