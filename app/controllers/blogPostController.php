<?php
//require 'ressources/views/header.tpl.php';

if (filter_has_var(INPUT_GET, 'id')) {
    $id_post = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
    $post_result = blogPostById($pdo, $id_post);
    $comments_result = commentsByBlogPost($pdo, $id_post);
    require 'ressources/views/blogPost.tpl.php';
} else {
    printf("\nPas de numéro de post renseigné");
}

//require 'ressources/views/footer.tpl.php';