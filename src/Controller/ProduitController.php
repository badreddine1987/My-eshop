<?php

namespace App\Controller;


use DateTime;
use App\Entity\Produit;
use App\Form\ProduitFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route("/admin")]
class ProduitController extends AbstractController
{
    #[Route('/voir-les-produits', name: 'show_produits', methods: ['GET'])]
    public function showProduuits(EntityManagerInterface $entityManager): Response
    {
        #Récupération en BDD de toutes les entités Produits, grace au repository
        $produits = $entityManager->getRepository(Produit::class)->findBy(['deletedAt' => null]);

        return $this->render('admin/produit/show_produits.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/voir-les-archives', name: 'show_trash', methods: ['GET'])]
    public function showTrash(EntityManagerInterface $entityManager): Response
    {
        return $this->render('admin/produit/show_trash.html.twig');
    }

# 1 - Créer un prototype de formulaire en ligne de commande ProduitFormType
    # 2 - Créer une action dans ProduitController pour la création d'un produit
    # 3 - Rendre la vue twig du formulaire
    # 4 - Créer le fichier Twig de cette vue.
    # 5 - Finir la partie POST dans l'action.

    #[Route('/Ajouter-un-produit', name: 'create_produit', methods: ['GET', 'POST'])]
    public function createProduit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $produit = new Produit();

        $form = $this->createForm(ProduitFormType::class, $produit)
                ->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){

                    $produit->setCreatedAt(new DateTime());
                    $produit->setUpdatedAt(new DateTime());


                    $photo = $form->get('photo')->getData();

                    if($photo){
                        $this->handleFile($produit, $photo, $slugger);
                    } // end if photo


                    $entityManager->persist($produit);
                    $entityManager->flush();

                    $this->addFlash('success', 'Produit ajouter avec succes');

                    return $this->redirectToRoute('show_produits');
            } // end form

        return $this->render('admin/produit/create_produits.html.twig', [
            'form_produit' => $form->createView(),
            
        ]);
    } // end function create

    #[Route('/modifier-le-produit/{id}', name: 'update_produit', methods: ['GET', 'POST'])]
    public function updateProduit(Produit $produit, Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        # Récuperation de la photo
        $originalPhoto = $produit->getPhoto();

        $form = $this->createForm(ProduitFormType::class, $produit, [
            'photo' => $originalPhoto
        ])->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $produit->setUpdatedAt(new DateTime());
            $photo = $form->get('photo')->getData();

            if($photo) {
                // Méthode crée par nous-meme pour réutiliser
                $this->handleFile($produit, $photo, $slugger);
            }else {
                $produit->setPhoto($originalPhoto);
            } // end if photo

            $entityManager->persist($produit);
            $entityManager->flush();
    
            $this->addFlash('success', 'Produit Modifier avec succes');
            
            return $this->redirectToRoute('show_produits');
        } // end form
        
        
        return $this->render('admin/produit/create_produits.html.twig', [
            'form_produit' => $form->createView(),
            'produit' => $produit
        ]);
    } // end function update_produit
    
    #[Route('/archiver-un-produit/{id}', name: 'archiver_un_produit', methods: ['GET'])]
    public function softDeleteProduit(Produit $produit, EntityManagerInterface $entityManager) : RedirectResponse 
    {
        $produit->setDeletedAt(new DateTime());
        
        $entityManager->persist($produit);
        $entityManager->flush();
        
        $this->addFlash('success', 'Produit à bien était atrchiver');
        return $this->redirectToRoute('show_produits');
        
    }



    /**
     * Undocumented function
     *
     * @param Produit $produit
     * @param UploadedFile $photo
     * @param SluggerInterface $slugger
     * @return void
     */
    private function handleFile(Produit $produit, UploadedFile $photo, SluggerInterface $slugger): void
    {
        # 1 - Déconstruire le nom du fichier

                        # a - On récupère l'extension grâce à la méthode guessExtension()
                        $extension = '.' . $photo->guessExtension();
                        # 2 - Sécuriser le nom et le reconstruire le nouveau nom du fichier
                        # a - On assainit le nom du fichier pour suprimer les espaces et les accents
                            $safeFilename = $slugger->slug($photo->getClientOriginalName());

                        # b - On reconstruit le nom du fichier
                        # uniqid() est une fonction native de PHP qui genere un identifiant unique
                        $newFilename = $safeFilename . '_' . uniqid() . $extension;


                        # 3 - Déplacer le fichier dans le bon dossier  
                        # try/catch

                        try {
                            # On a défini un paramètre dans config/service.yaml qui est le chemin du dossier "uploads"
                            # On utilise un try/catch lorsqu'une méthode "throws" (lance) une Exception (erreur)
                            $photo->move($this->getParameter('uploads_dir'), $newFilename);
                            # Si tout est bon après le move(), on set le nom de la photo.
                            $produit->setPhoto($newFilename);
                        }
                        catch(FileException $exception) {
                            $this->addFlash('warning', 'La photo du produit ne s\'est pas importée avec succès. Veuillez réessayer.');
                            

                            }
    } // end handleFile

} // end class
