<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThematiquesController extends AbstractController
{
    /**
     * @Route("/thematiques", name="thematiques")
     */
    public function pageThematiques(): Response
    {
        return $this->render('thematiques/thematiques.html.twig', [
            'controller_name' => 'ThematiquesController',
        ]);
    }
}
