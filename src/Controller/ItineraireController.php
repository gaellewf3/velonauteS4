<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItineraireController extends AbstractController
{
    /**
     * @Route("itineraire", name="tineraire")
     */
    public function index(): Response
    {
        return $this->render('admin/itineraire/index.html.twig', [
            'controller_name' => 'ItineraireController',
        ]);
    }
}
