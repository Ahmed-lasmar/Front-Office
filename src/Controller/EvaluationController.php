<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Entity\Evaluation;
use App\Form\EvaluationType;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/evaluation')]
class EvaluationController extends AbstractController
{
    #[Route('/email', name: 'emailev')]
    public function sendMail(Swift_Mailer $mailer, Request $request): Response
    {
        if($request->get('avis')=="In review"){
            $email = (new Swift_Message('Resultat Entretien'))
                ->setFrom('chadi.troudi@esprit.tn')
                ->setTo('racem.benamar@esprit.tn')
                ->setBody("<p> Bonjour  ".$request->get('fname')." </p>La résultat de votre entretien: ".$request->get('avis')."<p>Vous serez notifiez lors du changement de l'état d'évaluation.</p><p>Cordialement,</p>",
                    "text/html");
            $mailer->send($email);
            $this->addFlash('message','E-mail de résultat de l`entretien :');
        }

        elseif($request->get('avis')=="Refused") {
            $email = (new Swift_Message('Resultat Entretien'))
                ->setFrom('chadi.troudi@esprit.tn')
                ->setTo('racem.benamar@esprit.tn')
                ->setBody("<p> Bonjour  ".$request->get('fname')." </p>La résultat de votre entretien: ".$request->get('avis')."<p> Malheuresement votre évaluation n'étais pas à la hauteur. Bon courage dans votre future.</p><p>Cordialement,</p>",
                    "text/html");
            $mailer->send($email);
            $this->addFlash('message','E-mail de résultat de l`entretien :');
        }

        elseif($request->get('avis')=="Accepted") {
            $email = (new Swift_Message('Resultat Entretien'))
                ->setFrom('chadi.troudi@esprit.tn')
                ->setTo('racem.benamar@esprit.tn')
                ->setBody("<p> Bonjour  ".$request->get('fname')." </p>La résultat de votre entretien: ".$request->get('avis')."<p> Vous serez notifiez par les prochaines procedures.</p><p>Cordialement,</p>",
                    "text/html");
            $mailer->send($email);
            $this->addFlash('message','E-mail de résultat de l`entretien :');
        }

        return $this->redirectToRoute('app_evaluation_index');

    }



    #[Route('/', name: 'app_evaluation_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,Request $request): Response
    {
        $evaluations = $entityManager
            ->getRepository(Evaluation::class)
            ->findAll();
        $entretiens  = $entityManager
            ->getRepository(Entretien::class)
            ->findAll();

        $firstName=$entityManager ->getRepository(Evaluation::class)->findAll();
        //$name=$entityManager ->getRepository(Evaluation::class)->findAll();
        $note=$entityManager ->getRepository(Evaluation::class)->findAll();
        $categFname = [];
        //$categName = [];
        $categNote = [];

        foreach($firstName as $fn ){
            if ($fn->getEntretien() != null)
            $categFname[] = $fn->getEntretien()->getFirstnameCandidat();

        }
        /*
         * foreach($name as $nom ){
            $categName[] = $nom->getEntretien()->getNameCandidat();
        }*/
        foreach($note as $n ){
            $categNote[] = $n->getNote();
        }




        return $this->render('evaluation/index.html.twig', [
            'evaluations' => $evaluations,
            'entretiens' => $entretiens,
            'nom'=>json_encode($categFname),
            'note'=>json_encode($categNote),

        ]);
    }

    #[Route('/new', name: 'app_evaluation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $evaluation = new Evaluation();
        $form = $this->createForm(EvaluationType::class, $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($evaluation);
            $entityManager->flush();

            return $this->redirectToRoute('app_evaluation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evaluation/new.html.twig', [
            'evaluation' => $evaluation,
            'form' => $form,

        ]);
    }

    #[Route('/{idEvaluation}', name: 'app_evaluation_show', methods: ['GET'])]
    public function show(Evaluation $evaluation): Response
    {
        return $this->render('evaluation/show.html.twig', [
            'evaluation' => $evaluation,
        ]);
    }

    #[Route('/{idEvaluation}/edit', name: 'app_evaluation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evaluation $evaluation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvaluationType::class, $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evaluation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evaluation/edit.html.twig', [
            'evaluation' => $evaluation,
            'form' => $form,
        ]);
    }

    #[Route('/{idEvaluation}', name: 'app_evaluation_delete', methods: ['POST'])]
    public function delete(Request $request, Evaluation $evaluation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evaluation->getIdEvaluation(), $request->request->get('_token'))) {
            $entityManager->remove($evaluation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evaluation_index', [], Response::HTTP_SEE_OTHER);
    }


}
