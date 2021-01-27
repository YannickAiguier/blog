<?php
require 'header.tpl.php';
require 'app/persistences/blogPostData.php';

if (filter_has_var(INPUT_GET, 'id')) {
    $id_post = (int)filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $request_result = blogPostById($pdo, $id_post);
    if (empty($request_result)):
        // pas de post
        print("\nPas de post !!!");
    else:
        foreach ($request_result as $row) {
            printf("<li>%s : %s / %s</li>", $row['pseudo'], $row['title'], $row['text']);
        }
    endif;
    echo '<br>';
    $request_result = commentsByBlogPost($pdo, $id_post);
    if (empty($request_result)):
        // pas de commentaires
        print("\nAucun commentaire !!!");
    else:
        foreach ($request_result as $row) {
            printf("<li>%s : %s</li>", $row['pseudo'], $row['comment']);
        }
    endif;
} else {
    printf("\nPas de numéro de post renseigné");
}

require 'footer.tpl.php';