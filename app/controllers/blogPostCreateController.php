<?php

require_once 'app/persistences/blogPostData.php';

$articlesTable = "";

$result_form = [
    'post-title' => '',
    'post-text' => '',
    'post-start-date' => '',
    'post-end-date' => '',
    'post-degree' => '',
    'post-author' => '',
    'post-articles' => ''];

$args = [
    'post-title' => FILTER_SANITIZE_STRING,
    'post-text' => FILTER_SANITIZE_STRING,
    'post-start-date' => FILTER_SANITIZE_STRING,
    'post-end-date' => FILTER_SANITIZE_STRING,
    'post-degree' => FILTER_SANITIZE_STRING,
    'post-author' => FILTER_SANITIZE_STRING,
    'post-categories' => FILTER_SANITIZE_STRING];

// tester présence $_POST (si présent alors formulaire rempli)
if (!empty($_POST)) { // traiter les données du formulaire
    $result_form = filter_input_array(INPUT_POST, $args);

    // formater les categories en tableau
    $articlesTable = explode(" ", $result_form['post-categories']);

    // appeler la fonction d'insertion
    blogPostCreate($pdo, $result_form['post-title'], $result_form['post-text'], $result_form['post-start-date'], $result_form['post-end-date'], $result_form['post-degree'], $result_form['post-author'], $articlesTable);

    // affichage de la page de confirmation
    $result_form = array_fill(0, count($result_form), '');
    header('Location: index.php?action=blogpostcreate_ok');

} else {
    require 'ressources/views/blogPostCreate.tpl.php';
}