<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Contrat;
use App\Entity\Offreemploi;
use App\Form\CandidatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

#[Route('/candidat')]
class CandidatController extends AbstractController
{
    #[Route('/', name: 'app_candidat_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $candidats = $entityManager
            ->getRepository(Candidat::class)
            ->findAll();

        return $this->render('candidat/index.html.twig', [
            'candidats' => $candidats,
        ]);
    }

    public function loginSuccess(TexterInterface $texter)
    {
        $sms = new SmsMessage(
        // the phone number to send the SMS message to
            '+21694465555',
            // the message
            'A new login was detected!'
        );

        $sentMessage = $texter->send($sms);

        // ...
    }

    /**
     * @throws ConfigurationException
     * @throws TwilioException
     */
    #[Route('/new', name: 'app_candidat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $candidat = new Candidat();
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);
        $url=$candidat->getUrlCv();
         $date=$candidat->getDPost()=== null ? '' :$candidat->getDPost()->format('Y-m-d')?? '';
        $competence=$candidat->getCompetence();
        $sid    = "AC34f9a95f1ec34776633bb8e0e7b488f2";
        $token  = "8aa38cd7f3c2594819e163ae7c60d52b";
        $twilio = new Client($sid, $token);
        if ($form->isSubmitted() && $form->isValid()) {


            $message = $twilio->messages
                ->create("+21694465555", // to
                    array(
                        "from" =>"+18635091531",
                        "body" => "Mr Radhwen, a new candidate was added at this day $date .The link showing his CV is: $url. Having skills : $competence"
                    )
                );

            print($message->sid);
            $entityManager->persist($candidat);
            $entityManager->flush();
            return $this->redirectToRoute('app_candidat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidat/new.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
        ]);
    }

    #[Route('/{idCan}', name: 'app_candidat_show', methods: ['GET'])]
    public function show(Candidat $candidat): Response
    {
        return $this->render('candidat/show.html.twig', [
            'candidat' => $candidat,
        ]);
    }

    #[Route('/{idCan}/edit', name: 'app_candidat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidat $candidat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_candidat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidat/edit.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
        ]);
    }

    #[Route('/{idCan}', name: 'app_candidat_delete', methods: ['POST'])]
    public function delete(Request $request, Candidat $candidat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidat->getIdCan(), $request->request->get('_token'))) {
            $entityManager->remove($candidat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_candidat_index', [], Response::HTTP_SEE_OTHER);
    }

    public function mostWantedSkilldql(EntityManagerInterface $entityManager): array
    {
        return $contrats=$entityManager->getRepository(Contrat::class)

            ->createQueryBuilder("oe")
            //->where('s.nsc= :val')
            //->andWhere('s.exampleField = :val')
            //->setParameter('val', $value)
                ->groupBy("skill")
            //->orderBy('oe.email', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }
    public function mostWantedSkillsql(EntityManagerInterface $entityManager){
        $query=$entityManager->createQuery('SELECT count(s) FROM App/Entity/Contrat s GROUP BY skill LIMIT 1');
    }
}
