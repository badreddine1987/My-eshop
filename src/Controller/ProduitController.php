<?php

namespace App\Controller;


use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route("/admin")]
class ProduitController extends AbstractController
{
    #[Route('/voir-les-produits', name: 'show_produits', methods: ['GET'])]
    public function showProduuits(EntityManagerInterface $entityManager): Response
    {
        #Récupération en BDD de toutes les entités Produits, grace au repository
        $produits = $entityManager->getRepository(Produit::class)->findAll();

        return $this->render('admin/produit/show_produits.html.twig', [
            'produits' => $produits,
        ]);
    }

# 1 - Créer un prototype de formulaire en ligne de commande ProduitFormType
    # 2 - Créer une action dans ProduitController pour la création d'un produit
    # 3 - Rendre la vue twig du formulaire
    # 4 - Créer le fichier Twig de cette vue.
    # 5 - Finir la partie POST dans l'action.


} // end class
