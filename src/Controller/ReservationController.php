<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'produit_list' => $produitRepository->findAll()
        ]);
    }
}
