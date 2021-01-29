<article>
    <header>
        <h1>Modifier un post</h1>
    </header>
    <?php foreach($post as $row) : ?>
        <form action="index.php?action=blogpostmodify" method="post">
            <h3><?=$row['title']?></h3>
            <p><?=$row['text']?></p>
            <input type="submit" value="Modifier">
            <input type="hidden" id="formid" name="post-id" value="<?=$row['id']?>">
            <input type="hidden" id="formtilte" name="post-title" value="<?=$row['title']?>">
            <input type="hidden" id="formtext" name="post-text" value="<?=$row['text']?>">
            <input type="hidden" id="formstartdate" name="post-start-date" value="<?=$row['start_date']?>">
            <input type="hidden" id="formenddate" name="post-end-date" value="<?=$row['end_date']?>">
            <input type="hidden" id="formdegree" name="post-degree" value="<?=$row['degree_of_importance']?>">
            <input type="hidden" id="formauthorsid" name="post-author" value="<?=$row['authors_id']?>">
            <input type="hidden" id="formselect" name="post-select" value="selected">
        </form>
    <?php endforeach; ?>
</article>