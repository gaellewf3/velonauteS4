<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitFormType;
use App\Form\ConfirmationFormType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/admin/produit", name="admin_produit")
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('admin/produit/index.html.twig', [
            'produit_list' => $produitRepository->findAll()
        ]);
    }

        /**
     * Modification 
     * @Route("/admin/produit/{id}/edit", name="produit_edit")
     */
    public function ProduitEdit(Produit $produit, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ProduitFormType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            $this->addFlash('success', 'Le produit a été mis à jour.');
            return $this->redirectToRoute('admin_produit');

        }

        return $this->render('admin/produit/produit_edit.html.twig', [
            'produit' => $produit,
            'produit_form' => $form->createView(),
        ]);
    }

        /**
     * Suppresion 
     * @Route("admin/produit/{id}/delete", name="produit_delete")
     */
    public function produitDelete(Produit $produit, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ConfirmationFormType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->remove($produit);
            $manager->flush();

            $this->addFlash('info', sprintf('Le produit "%s" a bien été supprimé.', $produit->getNom()));
            return $this->redirectToRoute('admin_produit');
        }

        return $this->render('admin/produit/produit_delete.html.twig', [
            'produit' => $produit,
            'confirmation_form' => $form->createView(),
        ]);
    }

        /**
     * Ajouter un produit
     * @Route("admin/produit/new", name="produit_add")
     */
    public function produitAdd(Request $request, EntityManagerInterface $manager)
    {   

        // 1. Créer le formulaire
        $form = $this->createForm(ProduitFormType::class);
        // 2. Passage de la requête au formulaire (récupération des données POST, validation)
        $form->handleRequest($request);

        // 3. Vérifier si le formulaire a été envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // 4. Récupérer les données de formulaire
            $produit = $form->getData();

            // Enregistrement en base de données
            $manager->persist($produit);
            $manager->flush();

            // Ajout d'un message flash
            $this->addFlash('success', 'Le nouvel produit a été enregistré.');
            return $this->redirectToRoute('produit_edit', ['id' => $produit->getId()]);
        }

        // On envoit une "vue de formulaire" au template
        return $this->render('admin/produit/produit_add.html.twig', [
            'produit_form' => $form->createView()
        ]);
    }
}
