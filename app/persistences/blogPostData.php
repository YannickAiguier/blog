<?php
// fonction pour exécuter la requête dans le fichier lastBlogPosts.sql
function lastBlogPosts(PDO $pdo)
{
    $requete = file_get_contents("database/lastBlogPosts.sql");
    return $pdo->query($requete);
}