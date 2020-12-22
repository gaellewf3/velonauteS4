<?php

namespace App\Controller\Admin;

use App\Repository\ItineraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItineraireController extends AbstractController
{
    /**
     * @Route("/admin/itineraire", name="admin_itineraire")
     */
    public function index(ItineraireRepository $itineraireRepository): Response
    {
        return $this->render('admin/itineraire/index.html.twig', [
            'itineraire' => $itineraireRepository->findAll()
        ]);
    }
}
