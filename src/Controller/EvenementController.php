<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/evenement')]
class EvenementController extends AbstractController
{


    #[Route('/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EvenementRepository $categorieRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $categorieRepository->findAll();
        $articles = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            3

        );
        return $this->render('evenement/index.html.twig', [
            'evenements' => $donnees,
        ]);

    }

    #[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($evenement);
            $entityManager->flush();
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->Username = 'mohamediheb.benslama@esprit.tn'; // YOUR gmail email
            $mail->Password = 'ahoubabn1999!'; // YOUR gmail password

            // Sender and recipient settings
            $mail->setFrom('mohamediheb.benslama@esprit.tn', 'mali');
            $mail->addAddress('mohamediheb.benslama@esprit.tn', 'Receiver Name');

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "Ajout d'un evenement";
            $mail->Body = '
<h1>Un nouveau évènement a été ajouté avec succes </h1>

    <a href="file:///C:/Users/iheb/Desktop/mail.html" > evenement</a>
  
';


            $mail->send();

            $this->addFlash(
                'Success',
                'Evènement Ajouté Avec Succés!'
            );

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{idevent}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/{idevent}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{idevent}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getIdevent(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();

            $this->addFlash(
                'info',
                'delete successfully!'
            );
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }


    /*#[Route('/listevenm', name: 'app_evenement_pdf', methods: ['GET'])]
    public function list(EvenementRepository $evRepository): Response
    {
        // Configure Dompdf according to your needs
        $pdfoptions = new Options();
        $pdfoptions->set('defaultFont', 'Arial');
        $pdfoptions->set('tempDir', '.\www\DaryGym\public\uploads\images');


        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfoptions);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('evenement/index.html.twig', [
            'b' => $evRepository->findAll(),
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }*/

    /**
     * @Route("/stat/cat",name="statistiquesss")
     */
    public function statistiques(EvenementRepository $evenementRepository): Response
    {
        $p=$this->getDoctrine()->getRepository(Evenement::class);
        $nbs = $p->getNb();
        $data = [['Evenement']];
        foreach($nbs as $nb)
        {
            $data[] = array(
                $nb['p'], $nb['cat'])
            ;
        }
        $bar = new BarChart();
        $bar->getData()->setArrayToDataTable(
            $data
        );
        $bar->getOptions()->setTitle('Nombre des evenements');
        $bar->getOptions()->getTitleTextStyle()->setColor('#07600');
        $bar->getOptions()->getTitleTextStyle()->setFontSize(25);
        return $this->render('evenement/Stat.html.twig',
            array('piechart' => $bar,'nbs' => $nbs));
    }
}
