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

    


