<?php
// les lignes suivantes sont pour que les erreurs PHP soit affichées dans le navigateur,
// quelle que soit la config du serveur (ne les affiche pas par défaut)
error_reporting (E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('display_startup_errors',true);
ini_set('log_errors', false);

// tableau des routes
$routes = [
    'accueil' => 'app/controllers/homeController.php',
    'blogpost' => 'app/controllers/blogPostController.php',
    'blogpostcreate' => 'app/controllers/blogPostCreateController.php',
    'blogpostmodify' => 'app/controllers/blogPostModifyController.php',
    'blogpostmodifyselect' => 'app/controllers/blogPostModifySelectController.php',
    'blogpostdelete' => 'app/controllers/blogPostDeleteController.php',
    'blogpostdeleteselect' => 'app/controllers/blogPostDeleteSelectController.php',
    'blogpostcreate_ok' => 'ressources/views/blogpostcreate_ok.html',
    'blogpostmodify_ok' => 'ressources/views/blogpostmodify_ok.html',
    'blogpostdelete_ok' => 'ressources/views/blogpostdelete_ok.html',
    '404' => 'pages/404' // a changer, definir une page 404 et son emplacement
];

if (filter_has_var(INPUT_GET, 'action')) { // action a réaliser
    $page = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if (!array_key_exists($page, $routes)) {
        header("HTTP/1.0 404 Not Found");
        $page = '404';
    }
} else { // page par défaut
    $page = 'accueil';
}
require_once 'config/database.php';                 // contient l'objet pdo pour connexion à la base
require_once 'app/persistences/blogPostData.php';   // contient les fonctions de requêtes sur la base
require 'ressources/views/header.tpl.php';
require $routes[$page];
require 'ressources/views/footer.tpl.php';