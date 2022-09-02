<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/voir-mon-panier', name: 'show_panier', methods: ['GET'])]
    public function showPanier(SessionInterface $session): Response
    {

        $panier = $session->get('panier', []);
        $total = 0;

        foreach ($panier as $item){

            # Pour chaque produit, on fait le total
            $totalItem = $item['produit']->getPrice() * $item['quantity'];
            # On ajoute ce total au montant final
            $total += $totalItem;
           
        }

      

        return $this->render('panier/show_panier.html.twig', [
            'total' => $total,
        ]);

    } //end showPanier()

    #[Route('/ajouter un produit/{id}', name: 'add_item', methods: ['GET'])]
    public function addItem(Produit $produit, SessionInterface $session): Response
    {
        # Si dans $session le panier n'existe pas,
        # alors la methode get() retourenera le second paramettre, array vide.
        $panier = $session->get('panier', []);

        if( !empty($panier[$produit->getId()]) ){

            ++$panier[$produit->getId()]['quantity'];

        }else{

            $panier[$produit->getId()]['quantity'] = 1;
            $panier[$produit->getId()]['produit'] = $produit;

        } // end if()

        # Ici, nous devons set() le panier en session, en lui passant $panier[]
        $session->set('panier', $panier);

        $this->addFlash('success', 'Le Produit a bien été ajouté à votre panier');
        return $this->redirectToRoute('default_home');

    } // end addItem()
} // end  class PanierController
