<?php

namespace App\Controller;

use App\Entity\Paiement;
use App\Form\PaiementFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaiementController extends AbstractController
{
    /**
     * @Route("/paiement", name="paiement")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $paiement = new Paiement();
        $form = $this->createForm(PaiementFormType::class);

        $form->handleRequest($request);

        // 3. Vérifier si le formulaire a été envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // 4. Récupérer les données de formulaire
            $paiement = $form->getData();

            // Enregistrement en base de données
            $manager->persist($paiement);
            $manager->flush();

            // Ajout d'un message flash
            $this->addFlash('success', 'Le paiement a été enregistré.');
            return $this->redirectToRoute('paiement');
        }

        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController',
            'paiement_form' => $form->createView()
        ]);
    }
}
