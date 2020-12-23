<?php

namespace App\Controller\Admin;

// use App\Form\UserFormType;
use App\Form\ItineraireFormType;
use App\Repository\ItineraireRepository;
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


    

   /**
     * AFFICHER Liste des itineraires
     * @Route("/itineraire", name="itineraire")
     */
    public function itineraireList(ItineraireRepository $itineraireRepository)
    {
        return $this->render('admin/dashboard/itineraire_list.html.twig', [
            'itineraire_list' => $itineraireRepository->findAll(),
        ]);
    }



     /** AJOUTER un itineraire
     * @Route("/itineraire/new", name="itineraire_add")
     */

    public function itineraireAdd(Request $request, EntityManagerInterface $manager) 
    {
                //1.Créer le formulaire
                $form = $this->createForm(ItineraireFormType::class);

                //2. Passage de la requete au formulaire (recuperation des donnes POST, validation)
                $form->handleRequest($request);

                //3. verifier so le form a été envpyé et est vélidé
                if($form->isSubmitted() && $form->isValid()){

                    //4. recupérer les données de formulaire
                    $itineraire = $form->getData();
                  
                    //enregistrement en bdd 
                    $manager->persist($itineraire);
                    $manager->flush();

                    //ajout d'un message flash
                    //des quil est affiche on considere quil est lu, donc il sefface
                    $this->addFlash('success', 'Le nouvel itineraire a été enregistré. ');
                    return $this->redirectToRoute('admin_itineraire_edit', ['id' => $itineraire->getId()]);
                }

                //on envoit une "vue de formulaire" au template
                return $this->render('admin/dashboard/itineraire_add.html.twig', [
                    'itineraire_form' => $form->createView()
                ]);
    }
}

// A FAIRE 
// Modification d'un itineraire
// suppression d'itineraire 