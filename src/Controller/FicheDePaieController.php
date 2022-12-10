<?php

namespace App\Controller;
use App\Entity\FicheDePaie;
use App\Form\FicheDePaieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
#[Route('/fiche/de/paie')]
class FicheDePaieController extends AbstractController
{
    #[Route('/', name: 'app_fiche_de_paie_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager ): Response
    {
        $ficheDePaies = $entityManager
            ->getRepository(FicheDePaie::class)
            ->findAll();

        return $this->render('fiche_de_paie/index.html.twig', [
            'fiche_de_paies' => $ficheDePaies,
        ]);
    }

    
    #[Route('/recherche', name: 'recherchey', methods: ['GET', 'POST'])]

    public function recherche(Request $req, EntityManagerInterface $entityManager)
    {
        $data = $req->get('searche');
        $repository = $entityManager->getRepository(FicheDePaie::class);
        $fiche_de_paies = $repository->findBy(['etatPaiement' => $data]);
        return $this->render('fiche_de_paie/index.html.twig', [
            'fiche_de_paies' => $fiche_de_paies
        ]);
    }
    #[Route('/pdfffd', name:'fichedepaiepdf')]
    public function indexyessin(EntityManagerInterface $entityManager)

    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $ficheDePaies=$entityManager->getRepository(FicheDePaie::class)->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->render('fiche_de_paie/liste.html.twig', [
            'fiche_de_paies' => $ficheDePaies,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
        return new Response();

    }

    /**
     * @Route("/triidd", name="triidd")
     */

    public function Triid(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT c FROM App\Entity\FicheDePaie c 
            ORDER BY c.salaireInit'
        );


        $fiche_de_paies = $query->getResult();

        return $this->render('fiche_de_paie/index.html.twig',
            array('fiche_de_paies' => $fiche_de_paies));

    }

    #[Route('/new', name: 'app_fiche_de_paie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ficheDePaie = new FicheDePaie();
        $form = $this->createForm(FicheDePaieType::class, $ficheDePaie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ficheDePaie);
            $entityManager->flush();

            return $this->redirectToRoute('app_fiche_de_paie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fiche_de_paie/new.html.twig', [
            'fiche_de_paie' => $ficheDePaie,
            'form' => $form,
        ]);
    }

    #[Route('/s/{idFp}', name: 'app_fiche_de_paie_show', methods: ['GET'])]
    public function show(FicheDePaie $ficheDePaie): Response
    {
        return $this->render('fiche_de_paie/show.html.twig', [
            'fiche_de_paie' => $ficheDePaie,
        ]);
    }

    #[Route('/{idFp}/edit', name: 'app_fiche_de_paie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FicheDePaie $ficheDePaie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FicheDePaieType::class, $ficheDePaie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fiche_de_paie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fiche_de_paie/edit.html.twig', [
            'fiche_de_paie' => $ficheDePaie,
            'form' => $form,
        ]);
    }

    #[Route('/d/{idFp}', name: 'app_fiche_de_paie_delete', methods: ['POST'])]
    public function delete(Request $request, FicheDePaie $ficheDePaie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ficheDePaie->getIdFp(), $request->request->get('_token'))) {
            $entityManager->remove($ficheDePaie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fiche_de_paie_index', [], Response::HTTP_SEE_OTHER);
    }



    //#[Route('/pdf/{id}', name:'fichedepaie.pdf')]
    //public function generatePdfPersonne(FicheDePaie $ficheDePaie = null, PdfService $pdf){
      //  $html = $this->render('fiche_de_paie/show.html.twig',['fichedepaie'=> $ficheDePaie]);
        //$pdf->showPdfFile($html);
    //}
}

