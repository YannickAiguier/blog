
<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=blog', 'blogmaster', 'blog2021campus');
} catch (PDOException $e) {
    print "Erreur ! : ".$e->getMessage()."<br>";
}