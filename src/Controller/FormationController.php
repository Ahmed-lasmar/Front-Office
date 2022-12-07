<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Image;
use App\Form\FormationType;
use App\Services\QrcodeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formation')]
class FormationController extends AbstractController
{
    #[Route('/', name: 'app_formation_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $formations = $entityManager
            ->getRepository(Formation::class)
            ->findAll();

        return $this->render('formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/new', name: 'app_formation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, QrcodeService $qrcodeService): Response
    {
        $qrCode =null;

        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //qr-code
            $qrcodeService->qrcode("c'est une formation de ". $formation->getNomFor()." de nombre de participants maximum".$formation->getNumbrMaxPer());
            // On récupère les images transmises
            $images = $form->get('image')->getData();

            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('image_directory'),
                    $fichier
                );

                // On stocke l'image dans la base de données (son nom)
                $img = new Image();
                $img->setName($fichier);
                $formation->addImage($img);
            }

            $entityManager->persist($formation);
            $entityManager->flush();


            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form,
            'qrCode'=>$qrCode
        ]);
    }


    #[Route('/{idFor}', name: 'app_formation_show', methods: ['GET'])]
    public function show(Formation $formation): Response
    {
        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }

    #[Route('/{idFor}/edit', name: 'app_formation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formation $formation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    #[Route('/{idFor}', name: 'app_formation_delete', methods: ['POST'])]
    public function delete(Request $request, Formation $formation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getIdFor(), $request->request->get('_token'))) {
            $entityManager->remove($formation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @route("/recherche",name="recherche" ,methods={"GET","POST"})
     *
     *
     */
    public function recherche(Request $req, EntityManagerInterface $entityManager)
    {
        $data = $req->get('searche');
        $repository = $entityManager->getRepository(Formation::class);
        $produits = $repository->findBy(['nomFor' => $data]);
        return $this->render('formation/index.html.twig', [
            'formations' => $produits
        ]);
    }
}
