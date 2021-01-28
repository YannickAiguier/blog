<main>
<div id="formulaire">
<h1>Ecrire un post</h1>
<form action="index.php?action=createpost" method="POST">
    <p><label for="formtitle">Titre : </label>
    <input type="text" id="formtitle", name="post-title"></p>

    <p><label for="formtext">Texte : </label>
    <textarea name="post-text" id="formtext" cols="=30" rows="5"></textarea></p>

    <p><label for="formstartdate">Début de publication : </label>
    <input type="date" id="formstartdate" name="post-start-date"></p>

    <p></p><label for="formenddate">Fin de publication : </label>
    <input type="date" id="formanddate" name="post-end-date"></p>

    <p><label for="formdegree">Degré d'importance</label>
    <input list="degree_of_importance" id="formdegree" name="post-degree"/>
    <datalist id="degree_of_importance">
        <option value="1">
        <option value="2">
        <option value="3">
        <option value="4">
        <option value="5">
    </datalist></p>

    <p><label for="formauthor">Auteur : </label>
    <input list="authors" id="formauthor" name="post-author"/>
    <datalist id="authors">
        // ici faire un foreach avec résultat requête de tous les PSEUDO d'auteurs
        <?php foreach ($authorsPseudos as $row): ?>
        <option value="<?=$row['pseudo']?>">
        <?php endforeach; ?>
    </datalist></p>

    <p><label for="formcategories">Numéros de catégories (optionnel) : </label>
        <input type="text" id="formcategories" name="post-categories"></p>

    <button type="submit">Ajouter</button>

    </form>
</main>