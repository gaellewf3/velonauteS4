<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(SessionInterface $session, ProduitRepository $produitRepository)
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $produitRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach($panierWithData as $item) {
            $totalItem = $item['product']->getPrix() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function cartAdd($id, SessionInterface $session) 
    {
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        
        $session->set('panier', $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/panier/delete/{id}", name="cart_delete")
     */
    public function cartDelete($id, SessionInterface $session ) {
        $panier = $session->get('panier', []);
        
        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("cart_index");
    }
}
