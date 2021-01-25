<?php

$routes = [
    '' => 'app/controllers/homeController.php',
    'accueil' => 'app/controllers/homeController.php',
    'index.php' => 'app/controllers/homeController.php',
    '404' => 'pages/404' // a changer, definir une page 404 et son emplacement
];
if (isset($_GET['action'])) { // action a réaliser
    $page = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if (!array_key_exists($page, $routes)) {
        $page = '404';
    }
} else { // page par défaut
    $page = 'accueil';
}
require 'config/database.php';
require $routes[$page];
