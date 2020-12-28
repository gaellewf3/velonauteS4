<?php

namespace App\Controller;

use App\Entity\Itineraire;
use App\Repository\ItineraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItineraireController extends AbstractController
{
    /**
     * Liste des itinéraires
     * @Route("/itineraire-list", name="itineraire_list")
     */
    public function index(ItineraireRepository $itineraireRepository): Response
    {
        return $this->render('itineraire/itineraire_list.html.twig', [
            'itineraire_list' => $itineraireRepository->findAll()
        ]);
    }

    /**
     * @Route("/itineraire/{id<\d+>}", name="itineraire")
     */
    public function itinerairePage(Itineraire $itineraire): Response
    {
        return $this->render('itineraire/itineraire_page.html.twig', [
            'itineraire' => $itineraire,
        ]);
    }
}
