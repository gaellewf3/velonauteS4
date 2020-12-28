<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuccessPageController extends AbstractController
{
    /**
     * @Route("/success/page", name="success_page")
     */
    public function index(): Response
    {
        return $this->render('success_page/index.html.twig', [
            'controller_name' => 'SuccessPageController',
        ]);
    }
}
