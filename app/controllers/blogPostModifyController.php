<?php

$args = [
    'post-id' => FILTER_SANITIZE_STRING,
    'post-title' => FILTER_SANITIZE_STRING,
    'post-text' => FILTER_SANITIZE_STRING,
    'post-start-date' => FILTER_SANITIZE_STRING,
    'post-end-date' => FILTER_SANITIZE_STRING,
    'post-degree' => FILTER_SANITIZE_STRING,
    'post-author' => FILTER_SANITIZE_STRING,
    'post-select' => FILTER_SANITIZE_STRING];

//tester présence $_POST (si présent alors le formulaire a été formulaire envoyé pour modification)
if (!empty($_POST)) { // traiter les données du formulaire
    $result_form = filter_input_array(INPUT_POST, $args);
    // si $result_form['post-select'] existe c'est que l'on est passé par blogPostUpdateSelect
    if (isset($result_form['post-select'])) {
        $post = blogPostByIdForUpdate($pdo, $result_form['post-id']);
        require 'ressources/views/blogPostUpdate.tpl.php';
    } else { // sinon le formulaire de modification a été validé
        // appeler la fonction pour modification du post
        blogPostUpdate($pdo, $result_form['post-id'], $result_form['post-title'], $result_form['post-text'], $result_form['post-start-date'], $result_form['post-end-date'], $result_form['post-degree'], $result_form['post-author']);

        // affichage de la page de confirmation
        $result_form = array_fill(0, count($result_form), '');
        header('Location: index.php?action=blogpostmodify_ok');
    }

} else { // sinon afficher dans le formulaire le post demandé pour modification
    if (filter_has_var(INPUT_GET, 'id')) {
        $postId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        if ($postId == "") {
            printf("\nNuméro de post mal renseigné");
        } else {
            // récupération de toutes les infos du post correspondant $_GET['id']
            $post = blogPostByIdForUpdate($pdo, $postId);
            if (!empty($post)) { // post trouvé, afficher les infos existantes dans le template
                require 'ressources/views/blogPostUpdate.tpl.php';
            } else {
                echo "Ce post n'existe pas";
            }
        }
    } else {
        printf("\nPas de numéro de post renseigné");
    }
}