<?php
// test de la fonction : OK
//blogPostUpdate($pdo, "60", "Post modifié par requête simple", "Si ce poste existe c'est que ma fonction de modification de post fonctionne", "2020-01-28 15:30:00", "2020-04-12 17:17:17", "4", "1");

$args = [
    'post-title' => FILTER_SANITIZE_STRING,
    'post-text' => FILTER_SANITIZE_STRING,
    'post-start-date' => FILTER_SANITIZE_STRING,
    'post-end-date' => FILTER_SANITIZE_STRING,
    'post-degree' => FILTER_SANITIZE_STRING,
    'post-author' => FILTER_SANITIZE_STRING];

//tester présence $_POST (si présent alors formulaire envoyé pour modification)
if (!empty($_POST)) { // traiter les données du formulaire
    $result_form = filter_input_array(INPUT_POST, $args);
    // appeler la fonction pour modification du post
    blogPostUpdate($pdo, $result_form['post-id'], $result_form['post-title'], $result_form['post-text'], $result_form['post-start-date'], $result_form['post-end-date'], $result_form['post-degree'], $result_form['post-author']);
    //$result_form = array_fill(0, count($result_form), '');
    //header('Location: index.php?action=php var
    //');
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