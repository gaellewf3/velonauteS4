<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/admin/produit", name="admin_produit")
     */
    public function index(): Response
    {
        return $this->render('admin/produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
}
