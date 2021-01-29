<?php if (empty($post_result)): ?>
    <p>Pas de post !!!</p>
<?php else: ?>
        <article>
            <header>
                <h2><?=$post_result['title']?></h2>
                <?=$post_result['pseudo']?>
            </header>
            <p><?=$post_result['text']?></p>

    <?php if (empty($comments_result)): ?>
               <p>Aucun commentaire !!!</p>
    <?php else: ?>
    <section>
        <?php foreach ($comments_result as $row) : ?>
            <article>
                <?=$row['pseudo']?> : <?=$row['comment']?>
            </article>
        <?php endforeach; ?>
    </section>
    <?php endif; ?>
<?php endif; ?>