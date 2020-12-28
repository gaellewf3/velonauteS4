<?php

namespace App\Controller;

use App\Repository\ItineraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        // dd($this);
        return $this->render('home/home.html.twig');
    }

    /**
     * Page FAQ
     * @Route("/faq", name="faq")
     */
    public function faqPage(HomeController $faq): Response
    {
        return $this->render('faq.html.twig', [
            'faq' => $faq
        ]);
    }

    /**
     * Page Mentions
     * @Route("/mentions", name="mentions")
     */
    public function mentionsPage(HomeController $mentions): Response
    {
        return $this->render('mentions.html.twig', [
            'mentions' => $mentions
        ]);
    }
}

 
