<article>
    <h1>Les 10 derniers posts</h1>
<?php if (empty($request_result)): ?>
    <p>Pas de post à afficher ou erreur de requête...</p>
<?php else:
    foreach ($request_result as $row) { ?>
        <li><?=$row['pseudo']?> : <a href="index.php?action=blogpost&id=<?=$row['id']?>"><?=$row['title']?></a> / <?=$row['text']?></li>
    <?php }
endif;?>
</article>