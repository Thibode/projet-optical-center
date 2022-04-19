<?php
// accessibilité à la session courante de l'utilisateur
session_start();

// Affichage de la partie haute 

include('./common/header.php');

// Pages autorisées : whitelist

include('./whitelist/web.php');

// Affichage de la navigation

if (isset($_GET['page']) && in_array($_GET['page'], $whitelist)) {
    include('./common/nav.php');
    include("page/" . $_GET['page'] . '.php');
} else {

    //si le champ page n'est pas accessible dans l'URL OU que l'accès à la page n'est pas possible
    //alors on le ramène à l'accueil

    header('Location: index.php?page=optical-table');
}

// Affichage de la partie basse 

include('./common/footer.php');