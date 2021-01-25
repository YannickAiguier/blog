<?php

$routes = [
    'defaut' => 'config/database.php',
    '404' => 'pages/404' // a changer, definir une page 404 et son emplacement
];
if (isset($_GET['action'])) { // action a réaliser
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
    if (!array_key_exists($page, $routes)) {
        $page = '404';
    }
} else { // page par défaut
    $page = 'defaut'; // a modifier ulterieurement
}
require 'config/database.php';
