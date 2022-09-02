<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Form\RegisterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'user_register', methods: ['GET', 'POST'])]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('default_home');
        }

        // 1 - Instanciation

        $user = new User();

        // 2 - Creation du formulaire + mécanisme d'auto-hydratation

        $form = $this->createForm(RegisterFormType::class, $user);
        $form->handleRequest($request);

        // 4 - au clic du bouton valider
        if($form->isSubmitted() && $form->isValid()){

            # set des proprietés qui ne sont pas dans le formulaire
            $user->setCreatedAt(new DateTime());
            $user->setUpdatedAt(new DateTime());
            # La propriétées "roles" est une array []
            $user->setRoles(['ROLE_USER']);

            // 5 - hash de mots de passe manuellement
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user, $form->get('password')->getData()
                    )
            );
            # mettre en BDD
            $entityManager->persist($user);
            $entityManager->flush();

            # La méthode addFlash() nous permet d'ajouter des messages destinés à l'utilisateur.
            # On pourra tous les afficher en front (avec Twig)
            $this->addFlash('success', 'Votre inscription à été effectué avec succès');
            return $this->redirectToRoute('default_home');
        }
        // 3- rendu de la vue Twig, avec le formulaire + createdVieuw() pour generer le HTML
        return $this->render('register/form.html.twig', [
            'form' => $form->createView() 
        ]);
    }
}
