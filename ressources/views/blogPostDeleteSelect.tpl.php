<article>
    <header>
        <h1>Modifier un post</h1>
    </header>
    <?php foreach($post as $row) : ?>
        <form action="index.php?action=blogpostdelete" method="post">
            <h3><?=$row['title']?></h3>
            <p><?=$row['text']?></p>
            <input type="submit" value="Effacer">
            <input type="hidden" id="formid" name="post-id" value="<?=$row['id']?>">
        </form>
    <?php endforeach; ?>
</article>