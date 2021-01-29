<?php

if (filter_has_var(INPUT_GET, 'id')) {
    $IntId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $IntpostId = intval($IntId); // conversion en entier pour éviter des problèmes d'insertion SQL

    if ($IntpostId == 0) { // autre chose qu'un nombre valide dans id
        printf("\nNuméro de post mal renseigné");
    } else { // suppression du post d'id $postId

        blogPostDelete($pdo, $IntId);


    }
} else {
    printf("\nPas de numéro de post renseigné");
}