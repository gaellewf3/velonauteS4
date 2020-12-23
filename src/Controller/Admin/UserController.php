<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/user", name="admin_user")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'user_list' => $userRepository->findAll()
        ]);
    }

    /**
     * Modification d'un user
     * @Route("/admin/user/{id}/edit", name="user_edit")
     */
    public function userEdit(User $user, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
        }

        return $this->render('admin/user/user_edit.html.twig', [
            'user' => $user,
            'user_form' => $form->createView(),
        ]);
    }
}
