<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DestinationController extends AbstractController
{
    /**
     * @Route("/destination", name="destination")
     */
    public function pageDestination(): Response
    {
        return $this->render('destination/destination.html.twig', [
            'controller_name' => 'DestinationController',
        ]);
    }
}
