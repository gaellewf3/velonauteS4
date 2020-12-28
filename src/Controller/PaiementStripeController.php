<?php

namespace App\Controller;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Entity\StripeTransaction;
use App\Form\StripeTransactionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

\Stripe\Stripe::setApiKey('sk_test_51Hn0YcKZ1Lm0H8l48VZhwPA2doYs84TnfuYhQ0hjhpcDMR4oqL3L41FuHe7f7N9ps9zrMZjdCn0jso21e17M5QHq00YeY6vgHu');

class PaiementStripeController extends AbstractController
{

    /**
     * @Route("/paiement/stripe", name="paiement_stripe")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $total = 0;

        if($request->getMethod() == 'GET') {
            $total = $request->query->get('total');
        }
        elseif ($request->getMethod() == 'POST') {
        
            $prenom = $request->request->get('prenom');
            $nom = $request->request->get('nom');
            $email = $request->request->get('email');
            $token = $request->request->get('stripeToken');
            $total = $request->request->get('total')*100;


            // Create Customer In Stripe
            $customer = \Stripe\Customer::create(array(
                "email" => $email,
                "source" => $token
            ));

            // Charge Customer
            $charge = \Stripe\Charge::create(array(
                "amount" => $total,
                "currency" => "eur",
                "description" => "Ma réservation",
                "customer" => $customer->id
            ));

            // Stripe transaction
            $transaction = new StripeTransaction();
            $transaction->setCustomerId($charge->customer);
            $transaction->setProduct($charge->description);
            $transaction->setAmount($charge->amount);
            $transaction->setCurrency($charge->currency);
            $transaction->setStatus($charge->status);


            // Enregistrement en base de données
            $manager->persist($transaction);
            $manager->flush();

            // Ajout d'un message flash
            $this->addFlash('success', 'Le paiement a ete effectue');
            return $this->redirectToRoute('paiement_stripe');
        }
        
        else if ($request->getMethod() == 'GET') {
            $total = $request->query->get('total');

            return $this->render('paiement_stripe/index.html.twig', [
                'controller_name' => 'PaiementStripeController',
                'total' => $total
            ]);
        }

        return $this->render('paiement_stripe/index.html.twig', [
            'controller_name' => 'PaiementStripeController',
            'total'=> $total

        ]);
    }
}
