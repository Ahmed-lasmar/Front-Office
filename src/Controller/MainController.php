<?php

namespace App\Controller;

use App\Entity\Offreemploi;
use App\Entity\Rate;
use App\Entity\User;
use App\Repository\ImageRepository;
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
        return $this->render('acceuil.html.twig');
    }
    #[Route('/mainrrh', name: 'app_main_rrh')]
    public function mainrrh(): Response
    {
        return $this->render('main/rrh.html.twig');
    }


    #[Route('/mainemp', name: 'app_main_emp', methods: ["GET"])]
    public function showFormation(EntityManagerInterface $entityManager, ImageRepository $imageRepository):Response
    {
        $liste=$imageRepository->findAll();
        return $this->render('main/Femp.html.twig',['list'=>$liste]);

    }

    #[Route('/{idcan}/maincan', name: 'app_main_can')]
    public function maincan(ImagesRepository $imagesRepository,EntityManagerInterface $entityManager,RateRepository $rateRepository,$idcan): Response
    {
        $list=$imagesRepository->findAll();
        $lists=$rateRepository->topRatedOffer();
        $candidat=$entityManager->getRepository(User::class)->find($idcan);
        $rate=new Rate();
        $rate->setUser($candidat);
        $rateRepository->add($rate,true);
        return $this->render('main/Can.html.twig',['list'=>$list,'lists'=>$lists]);
    }

    #[Route('/db', name: 'app_db')]
    public function db(): Response
    {
        return $this->render('DBbase.html.twig');
    }
    #[Route('{idcan}/portfolioDetails/{idOffre}', name: 'app_details')]
    public function details($idOffre,ImagesRepository $imagesRepository,EntityManagerInterface $entityManager,$idcan,RateRepository $rateRepository): Response
    {
        $candidat=$entityManager->getRepository(User::class)->find($idcan);
        $Offre=$imagesRepository->findByOffre($idOffre);
        $rating=$rateRepository->findByUser($idcan);
        $offre=$entityManager->getRepository(Offreemploi::class)->find($idOffre);
        $rate=new Rate();
        $rate->setUser($candidat);
        $rate->setOffreemploi($offre);
        $rateRepository->add($rate,true);
        return $this->render('main/portfolio-details.html.twig',['offre'=>$Offre,'candidat'=>$candidat,"rating"=>$rating]);
    }
    #[Route('{idcan}/portfolioDetails/{idOffre}/like', name: 'app_like_offer',  methods: ['GET', 'POST'])]
    public function likeOffer($idcan,EntityManagerInterface $entityManager,$idOffre,ImagesRepository $imagesRepository,RateRepository $rateRepository): Response
    {
        $lists=$rateRepository->topRatedOffer();
        $list=$imagesRepository->findAll();
        $candidat=$entityManager->getRepository(User::class)->find($idcan);
        $offre=$imagesRepository->findByOffre($idOffre);
        foreach($offre as $img){
            $rating=new Rate();

            $rating->setRating("like");
            $rating->setUser($candidat);
            $img->getOffreemploi()->addRating($rating);
           $rateRepository->add($rating,true);
            $entityManager->persist($rating);
            $entityManager->flush();
            // On stocke l'image dans la base de données (son nom)
            // $rating->setRating("like");
            //$offreemploi->addRating($rating);
        }

        return $this->render('main/portfolio-details.html.twig',['offre'=>$offre,'lists'=>$lists,"rating"=>$rating]);
    }
    #[Route('{idcan}/portfolioDetails/{idOffre}/dislike', name: 'app_dislike_offer',  methods: ['GET', 'POST'])]
    public function dislikeOffer(EntityManagerInterface $entityManager,$idOffre,ImagesRepository $imagesRepository,RateRepository $rateRepository,$idcan): Response
    {
        $list=$imagesRepository->findAll();
        $lists=$rateRepository->topRatedOffer();
        $candidat=$entityManager->getRepository(User::class)->find($idcan);
        $offre=$imagesRepository->findByOffre($idOffre);
        foreach($offre as $img){
            $rating=new Rate();
            $rating->setRating("dislike");
            $rating->setUser($candidat);
            $img->getOffreemploi()->addRating($rating);
            $rateRepository->add($rating,true);
            $entityManager->persist($rating);
            $entityManager->flush();
            // On stocke l'image dans la base de données (son nom)
            // $rating->setRating("like");
            //$offreemploi->addRating($rating);
        }

        return $this->render('main/portfolio-details.html.twig',['offre'=>$offre,'lists'=>$lists,"rating"=>$rating]);
    }
}
