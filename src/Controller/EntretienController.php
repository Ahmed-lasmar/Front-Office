<?php
namespace App\Controller;
use App\Entity\Entretien;
use App\Entity\Evaluation;
use App\Form\EntretienType;
use App\Form\EvaluationType;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function MongoDB\BSON\toJSON;

#[Route('/entretien')]
class EntretienController extends AbstractController
{
    #[Route('/email', name: 'email')]
    public function sendMail(Swift_Mailer $mailer, Request $request): Response
    {
        $email = (new Swift_Message('Passage Entretien'))
            ->setFrom('chadi.troudi@esprit.tn')
            ->setTo('racem.benamar@esprit.tn')
            ->setBody("<p> Bonjour ".$request->get('name')." </p>Votre entretien sera fixée au date: ".$request->get('date')." à ".$request->get('heure')." chez notre établissement."."<p>Cordialement,</p>",
                "text/html");
        $mailer->send($email);
        $this->addFlash('message','E-mail  de réinitialisation du mp envoyé :');
        return $this->redirectToRoute('app_entretien_index');
    }

    #[Route('/note', name: 'note', methods: ['GET', 'POST'])]
    public function note(Request $request, EntityManagerInterface $entityManager): Response
    {
        $idE= $request->get('id_ent');
        //$idEval= $request->get('idEvaluation');
        $fname= $request->get('fname');
        $name= $request->get('name');
        $evaluation = new Evaluation();
        $entretiens = $entityManager
            ->getRepository(Entretien::class)
            ->findAll();

        $form = $this->createForm(EvaluationType::class, $evaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cand=$entityManager->getRepository(Entretien::class)->find($idE);
            $evaluation->setEntretien($cand);

            $entityManager->persist($evaluation);
            $entityManager->flush();

            $evaluationId = $entityManager
                        ->getRepository(Evaluation::class)
                        ->findOneBy(['entretien'=>$idE]);
            $cand->setEvaluation($evaluationId);
            $entityManager->flush();


            return $this->redirectToRoute('app_evaluation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evaluation/note.html.twig', [
            'evaluation' => $evaluation,
            'form' => $form,
            'fname'=>$fname,
            'name'=>$name
        ]);
    }

    #[Route('/', name: 'app_entretien_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $entretiens = $entityManager
            ->getRepository(Entretien::class)
            ->findAll();

        $evaluation = new Evaluation();

        return $this->render('entretien/index.html.twig', [
            'entretiens' => $entretiens,
            'evaluations' => $evaluation,

        ]);
    }

    #[Route('/new', name: 'app_entretien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $idE= $request->get('idEvaluation');
        $idEnt= $request->get('id_ent');
        $entretien = new Entretien();
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$entretien->setEvaluation($evaluation->getIdEvaluation());
            //$evaluation->setEntretien($entretien->getIdEntretien());
            $entityManager->persist($entretien);
            $entityManager->flush();
            return $this->redirectToRoute('app_entretien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('entretien/new.html.twig', [
            'entretien' => $entretien,
            'form' => $form,
        ]);
    }

    #[Route('/{idEntretien}', name: 'app_entretien_show', methods: ['GET'])]
    public function show(Entretien $entretien): Response
    {
        return $this->render('entretien/show.html.twig', [
            'entretien' => $entretien,
        ]);
    }

    #[Route('/{idEntretien}/edit', name: 'app_entretien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Entretien $entretien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EntretienType::class, $entretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_entretien_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('entretien/edit.html.twig', [
            'entretien' => $entretien,
            'form' => $form,
        ]);
    }

    #[Route('/{idEntretien}', name: 'app_entretien_delete', methods: ['POST'])]
    public function delete(Request $request, Entretien $entretien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entretien->getIdEntretien(), $request->request->get('_token'))) {
            $entityManager->remove($entretien);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_entretien_index', [], Response::HTTP_SEE_OTHER);
    }


}