<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
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
    public function maincan(): Response
    {
        return $this->render('main/Can.html.twig');
    }

    #[Route('/db', name: 'app_db')]
    public function db(): Response
    {
        return $this->render('DBbase.html.twig');
    }
}
