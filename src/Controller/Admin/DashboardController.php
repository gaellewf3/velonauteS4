<?php

namespace App\Controller\Admin;

use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin_dashboard")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig');
    }

    // /**
    //  * Ajouter un user
    //  * @Route("/user/new", name="user_add")
    //  */
    // public function userAdd(Request $request, EntityManagerInterface $manager)

    // $form = $this->createForm(UserFormType::class);
    // $form->handleRequest($request);

    // if ($form->isSubmitted() && $form->isValid()
    // ) {
    //     $user = $form->getData();

    //     $manager->persist($user);
    //     $manager->flush();
    // }
}
