<?php
function lastBlogPosts(PDO $pdo) // affiche les 10 derniers posts
{
    $result = $pdo->query("SELECT posts.id,title,text,pseudo FROM posts INNER JOIN authors ON posts.authors_id=authors.id ORDER BY posts.id DESC LIMIT 10");
    if (!$result) { // erreur de requête ou tableau vide;
        return [];
    } else {
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

function blogPostById(PDO $pdo, string $fid) // récupère title, text, pseudo de l'auteur d'un post par son id
{
    $result = $pdo->prepare("SELECT title, text, pseudo FROM posts INNER JOIN authors ON posts.authors_id=authors.id WHERE posts.id=? ORDER BY posts.id DESC");
    $result->bindValue(1, $fid, PDO::PARAM_STR);
    $result->execute();
    if (!$result) {
        return [];
    } else {
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}

function commentsByBlogPost(PDO $pdo, string $fid) // récupère les commentaires associés à un post par l'id du post
{
    $result = $pdo->prepare("SELECT comment, pseudo FROM comments INNER JOIN authors ON comments.authors_id=authors.id INNER JOIN posts ON comments.posts_id=posts.id WHERE posts.id=? ORDER BY comments.id DESC");
    $result->bindValue(1, $fid, PDO::PARAM_STR);
    $result->execute();
    if (!$result) {
        return [];
    } else {
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

// insère un post dans la base, et ajoute également les correspondances avec les catégories si nécessaire
function blogPostCreate(PDO $pdo, string $ftitle, string $ftext, string $fstart_date, string $fend_date, string $fdegref_of_importance, string $fauthors_id, array $fcategories_id) {
    $result = $pdo->prepare("INSERT INTO posts (title, text, start_date, end_date, degree_of_importance, authors_id) VALUES (?, ?, ?, ?, ?, ?)");
    $result->bindParam(1, $ftitle, PDO::PARAM_STR);
    $result->bindParam(2, $ftext, PDO::PARAM_STR);
    $result->bindParam(3, $fstart_date, PDO::PARAM_STR);
    $result->bindParam(4, $fend_date, PDO::PARAM_STR);
    $result->bindParam(5, $fdegref_of_importance, PDO::PARAM_INT);
    $result->bindParam(6, $fauthors_id, PDO::PARAM_INT);
    $result->execute();
    if (!$result) {
        // erreur de requête, que faire ?
        echo "Raté...";
    } else {
        // requête ok, il faut faire les insertions dans la table categories_has_posts APRES avoir récupéré l'id du post ajouté juste avant
        $fposts_id = $pdo->lastInsertId();
        foreach($fcategories_id as $fid) {
            $result = $pdo->prepare("INSERT INTO categories_has_posts (categories_id, posts_id) VALUES (?, ?)");
            $result->bindParam(1, $fid, PDO::PARAM_INT);
            $result->bindParam(2, $fposts_id, PDO::PARAM_INT);
            $result->execute();
        }
    }
}

// met à jour un post
function blogPostUpdate(PDO $pdo, string $fid, string $ftitle, string $ftext, string $fstart_date, string $fend_date, string $fdegree_of_importance, string $fauthors_id) {
    $result = $pdo->prepare("UPDATE posts SET title=?, text=?, start_date=?, end_date=?, degree_of_importance=?, authors_id=? WHERE id=?");
    $result->bindParam(1, $ftitle, PDO::PARAM_STR);
    $result->bindParam(2, $ftext, PDO::PARAM_STR);
    $result->bindParam(3, $fstart_date, PDO::PARAM_STR);
    $result->bindParam(4, $fend_date, PDO::PARAM_STR);
    $degre = intval($fdegree_of_importance);
    $result->bindParam(5, $degre, PDO::PARAM_INT);
    $result->bindParam(6, $fauthors_id, PDO::PARAM_STR);
    $result->bindParam(7, $fid, PDO::PARAM_STR);
    $result->execute();
}

// récupère tous les champs d'un post par l'id du post (pour préreplir le formulaire de modification)
function blogPostByIdForUpdate(PDO $pdo, string $fid) {
    $result = $pdo->query("SELECT * FROM posts WHERE id=$fid");
    return $result->fetch(PDO::FETCH_ASSOC);
}

// fonction de suppression d'un post
function blogPostDelete(PDO $pdo, string $fid) {
    $result = $pdo->prepare("DELETE FROM categories_has_posts WHERE posts_id=?");
    $result->bindParam(1, $fid, PDO::PARAM_STR);
    $result->execute();
    $result = $pdo->prepare("DELETE FROM comments WHERE posts_id=?");
    $result->bindParam(1, $fid, PDO::PARAM_STR);
    $result->execute();
    $result = $pdo->prepare("DELETE FROM posts WHERE id=?");
    $result->bindParam(1, $fid, PDO::PARAM_STR);
    $result->execute();
}

// récupère tous les posts pour afficher dans les interfaces de modification et suppression
function blogPostAllPosts(PDO $pdo) { // récupère tous les posts
    $result = $pdo->query("SELECT * FROM posts");
    return $result->fetchAll(PDO::FETCH_ASSOC);
}