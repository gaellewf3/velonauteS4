<?php

namespace App\Controller\Admin;

// use App\Form\UserFormType;

 
 
use App\Form\ConfirmationFormType;

use App\Entity\Itineraire;
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
        return $this->render('admin/dashboard/accueil.html.twig');
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
                    // return $this->redirectToRoute('itineraire_list');
                }

                //on envoit une "vue de formulaire" au template
                return $this->render('admin/dashboard/itineraire_add.html.twig', [
                    'itineraire_form' => $form->createView()
                ]);
    }


    /**
     * 
     * Modification d'un itineraire
     * @Route("/itineraire/{id}/edit", name="itineraire_edit")
     */
    public function itineraireEdit(Itineraire $itineraire, Request $request, EntityManagerInterface $manager)
  
    {
        //on passe l'entité à modifier au formulaire
        //il sera pré-rempli, et l'entité sera automanitequement modifiée 
       $form = $this->createForm(ItineraireFormType::class, $itineraire);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()){
        //Pas d'appel à $form->getData():l'entité est mise à jour par le formulaire
        //pas d'appel à $manager->persist(): l'entité est déjà connu de l'EntityManager
        $manager->flush();
        $this->addFlash('success', 'L\'itineraire a été mis à jour.');
        return $this->redirectToRoute('admin_itineraire');

       }

       return $this->render('admin/dashboard/itineraire_edit.html.twig', [
           'itineraire' => $itineraire,
           'itineraire_form' => $form->createView(),
       ]);
    }

        /**
        * supprimer itineraire
     * @Route("/itineraire/{id}/delete", name="itineraire_delete")
       */
      public function itineraireDelete(Itineraire $itineraire, Request $request, 
      EntityManagerInterface $manager)
      {
          $form = $this->createForm(ConfirmationFormType::class);
          $form->handleRequest($request);
   
          if ($form->isSubmitted() && $form->isValid()) {
              $manager->remove($itineraire);       
              $manager->flush();     
              
              $this->addFlash('info', sprintf('L\'itineraire "%s" a bien été supprimé.', $itineraire->getNom()));
              return $this->redirectToRoute('admin_itineraire');
           }
   
          return $this->render('admin/dashboard/itineraire_delete.html.twig', [
              'itineraire' => $itineraire,
              'confirmation_form' => $form->createView(),
          ]);
      }





}

// A FAIRE 
// Modification d'un itineraire
// suppression d'itineraire 