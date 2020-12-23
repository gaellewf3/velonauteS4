<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitFormType;
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
}
