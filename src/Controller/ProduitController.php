<?php

namespace App\Controller;


use DateTime;
use App\Entity\Produit;
use App\Form\ProduitFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/Ajouter un produit', name: 'create_produit', methods: ['GET', 'POST'])]
    public function createProduit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();

        $form = $this->createForm(ProduitFormType::class, $produit)
                ->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){

                    $produit->setCreatedAt(new DateTime());
                    $produit->setUpdatedAt(new DateTime());

                    $entityManager->persist($produit);
                    $entityManager->flush();

                    return $this->redirectToRoute('default_home');
            }

        return $this->render('admin/produit/create_produits.html.twig', [
            'form_produit' => $form->createView(),
            
        ]);
    }

} // end class
