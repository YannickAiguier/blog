
<?php
// try - catch = gestion de l'erreur
try {
    // objet de connection à la base MySQL
    $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=UTF8', 'blogmaster', 'blog2021campus');
} catch (PDOException $e) {
    print "Erreur ! : ".$e->getMessage()."<br>";
}