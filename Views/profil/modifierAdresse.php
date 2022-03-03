<!-- <?= $recup ?> -->
<?php var_dump($allInfoById); ?>
<article>
    <form action="" method="post">
        <label for="nomAdresse">Nom de l'enregistrement : </label>
        <input type="text" id="nomAdresse" name="nomAdresse" aria-required="true" value="<?= $allInfoById[0]['nom_adresse'] ?>">

        <h2>Destinataire</h2>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" aria-required="true">

        <label for="prenom">Prenom :</label>
        <input type="text" id="prenom" name="prenom" aria-required="true">

        <h2>Adresse</h2>

        <label for="libelle">Libellé : </label>
        <input type="text" id="libelle" name="libelle" aria-required="true" value="<?= $allInfoById[0]['voie'] ?>">

        <label for="voieSup">Voie Sup : </label>
        <input type="text" id="voieSup" name="voieSup" aria-required="true" value="<?= $allInfoById[0]['voie_sup'] ?>">

        <label for="codePostal">Code Postal : </label>
        <input type="text" id="codePostal" name="codePostal" aria-required="true" value="<?= $allInfoById[0]['code_postal'] ?>">

        <label for="ville">Ville : </label>
        <input type="text" id="ville" name="ville" aria-required="true" value="<?= $allInfoById[0]['ville'] ?>">

        <label for="pays">Pays : </label>
        <input type="text" id="pays" name="pays" aria-required="true" value="<?= $allInfoById[0]['pays'] ?>">

        <label for="telephone">Telephone : </label>
        <input type="tel" id="telephone" name="telephone" aria-required="true" value="<?= $allInfoById[0]['telephone'] ?>">

        <input type="submit" name="mod" value="mod">
        <input type="submit" name="supprimer" value="supprimer">
    </form>
</article>