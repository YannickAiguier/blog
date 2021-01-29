<article>
    <header>
        <h1>Modifier un post</h1>
    </header>
    <form action="index.php?action=blogpostmodify" method="POST">
        <p><label for="formtitle">Titre : </label>
            <input type="text" id="formtitle" , name="post-title" value="<?= $post['title'] ?>"></p>

        <p><label for="formtext">Texte : </label>
            <textarea name="post-text" id="formtext" cols="=30" rows="5"><?= $post['text'] ?></textarea></p>

        <p><label for="formstartdate">Début de publication : </label>
            <input type="text" id="formstartdate" name="post-start-date" value="<?= $post['start_date'] ?>"></p>

        <p></p><label for="formenddate">Fin de publication : </label>
        <input type="text" id="formanddate" name="post-end-date" value="<?= $post['end_date'] ?>"></p>

        <p><label for="formdegree">Degré d'importance</label>
            <input list="degree_of_importance" id="formdegree" name="post-degree"
                   value="<?= $post['degree_of_importance'] ?>">
            <datalist id="degree_of_importance">
                <option value="1">
                <option value="2">
                <option value="3">
                <option value="4">
                <option value="5">
            </datalist>
        </p>

        <input type="hidden" id="formid" name="post-id" value="<?= $post['id'] ?>">

        <p><label for="formauthor">Auteur : </label>
            <input type="text id=" formauthor" name="post-author" value="<?= $post['authors_id'] ?>"></p>

        <button type="submit">Modifier</button>

    </form>
</article>