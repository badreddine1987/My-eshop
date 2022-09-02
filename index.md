<!-- (1) Creation-->
    1/ symfony new nom_projet --webapp
    2/ creation d'un fichier à la racine (.env.local)
    3/ connexion à la BDD
    -----DATABASE_URL="mysql://root:@127.0.0.1:3306/my-eshop?serverVersion=10.4.18-MariaDB&charset=utf8mb4"
    4/ creation de la BDD (Ne pas oublier de lancer le serveur local)
        => symfony console doctrine:database:create 
    5/lancer le serveur local 
        => symfony server: start

    6/ dans le fichier bas.html.twig
    -----------------------------------------------------------------------
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}My-eshop{% endblock %}</title>
        {# <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text></svg>"> #}
        {# Run `composer require symfony/webpack-encore-bundle` to start using Symfony UX #}
        {% block stylesheets %}
            {{ encore_entry_link_tags('app') }}
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        {% endblock %}

    </head>
    <body>
        {% block body %}{% endblock %}


        <!--===script====-->
        {% block javascripts %}
            {{ encore_entry_script_tags('app') }}
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        {% endblock %}
    </body>
</html>
-----------------------------------------------------------------------------------------------------
7/ creation de dossier (include dans le dossier template)
7.1 fichier => include/_nav.html.twig
7.2 fichier => include/_footer.html.twig

8/ include les fichier dans base.html.twig
    =>     {% include "include/_nav.html.twig" %}
    
        {% block body %}{% endblock %}

    =>{% include "include/_footer.html.twig" %}
-----------------------------------------------------------------------
9/ premier controller
    => symfony console make:controller
        => DefaultController
9.1 supprimer les fichier à l'interieur du dossier default dans template
9.2 dans le fichier controller de
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default_home', method: ['GET'])]
    public function home(): Response
    {
        return $this->render('default/home.html.twig');
    }
}


9.3 / creation du fichier home.html.twif

{% extends "base.html.twig" %}

{% block title %}Accueil{% endblock %}

{% block body %}
    <h1 class="text-center my-4">Bienvenue sur la boutique en ligne</h1>

{% endblock %}

10/ gitdesktop

    => add
    -> ADD existing repository

11/ creation entity 
Windows PowerShell
Copyright (C) Microsoft Corporation. Tous droits réservés.

Testez le nouveau système multiplateforme PowerShell https://aka.ms/pscore6

PS C:\Users\bhadj\Documents\Doranco\sf\semaine-2\My-eshop> symfony console make:controller

 Choose a name for your controller class (e.g. VictoriousPizzaController):
 > DefaultController

 created: templates/default/index.html.twig

 
  Success! 
 

 Next: Open your new controller class and add some pages!
PS C:\Users\bhadj\Documents\Doranco\sf\semaine-2\My-eshop> symfony console make:entity

 Class name of the entity to create or update (e.g. GentleElephant):
 > Produit

 created: src/Entity/Produit.php
 created: src/Repository/ProduitRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > title

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > description

 Field type (enter ? to see all types) [string]:
 > text

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > color

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 > 100

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > size

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 > 10

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > gender

 Field type (enter ? to see all types) [string]:
 >     

 Field length [255]:
 > 20

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > photo

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > price

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 > 10

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > stock

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 > 10

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > createdAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > updatedAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > deletedAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 > yes

 updated: src/Entity/Produit.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > ^Aerror sending signal interrupt not supported by windows
PS C:\Users\bhadj\Documents\Doranco\sf\semaine-2\My-eshop> symfony console make:entity Commande

 created: src/Entity/Commande.php
 created: src/Repository/CommandeRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > quantity

 Field type (enter ? to see all types) [string]:
 >    

 Field length [255]:
 > 5

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Commande.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > total

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 > 10

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Commande.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > status

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 > 25

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Commande.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > createdAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Commande.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > updatedAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 >          

 updated: src/Entity/Commande.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > deletedAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 > yes

 updated: src/Entity/Commande.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >


 
  Success! 
 

 Next: When you're ready, create a migration with php bin/console make:migration

PS C:\Users\bhadj\Documents\Doranco\sf\semaine-2\My-eshop> symfony console make:user User      

 Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:
 > yes

 Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:
 > email

 Will this app need to hash/check user passwords? Choose No if passwords are not needed or will be checked/hashed by some other system (e.g. a single sign-on server).

 Does this app need to hash/check user passwords? (yes/no) [yes]:
 > yes

 created: src/Entity/User.php
 created: src/Repository/UserRepository.php
 updated: src/Entity/User.php
 updated: config/packages/security.yaml

 
  Success!


 Next Steps:
   - Review your new App\Entity\User class.
   - Use make:entity to add more fields to your User entity and then run make:migration.
   - Create a way to authenticate! See https://symfony.com/doc/current/security.html
PS C:\Users\bhadj\Documents\Doranco\sf\semaine-2\My-eshop> symfony console make:entity User




 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > firstname

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 100

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > lastname

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 > 100

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > gender

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 > 20

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > createdAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > updatedAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > deletedAt

 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 > yes

 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


 
  Success! 
 

 Next: When you're ready, create a migration with php bin/console make:migration

PS C:\Users\bhadj\Documents\Doranco\sf\semaine-2\My-eshop> 


11/ une nouvelle route pour la partie Admin