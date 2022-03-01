<article>
    <h1>Adresse de Livraison</h1>

    <section>

        <?php for ($i = 0; $i <= 2; $i++) {
            if (isset($userAdresse[$i])) {
        ?>
                <a href=""><?= $userAdresse[$i]['nom_adresse'] ?></a>
            <?php
            } else {
            ?>
                <a href="">Nouvelle adresse</a>
        <?php
            }
        }
        ?>

    </section>

    <form action="" method="post">
        <label for="nomAdresse">Nom de l'enregistrement : </label>
        <input type="text" id="nomAdresse" name="nomAdresse" aria-required="true">

        <h2>Destinataire</h2>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" aria-required="true">

        <label for="prenom">Prenom :</label>
        <input type="text" id="prenom" name="prenom" aria-required="true">

        <h2>Adresse</h2>

        <label for="libelle">Libellé : </label>
        <input type="libelle" id="libelle" name="libelle" aria-required="true">

        <label for="voieSup">Voie Sup : </label>
        <input type="voieSup" id="voieSup" name="voieSup" aria-required="true">

        <label for="codePostal">Code Postal : </label>
        <input type="codePostal" id="codePostal" name="codePostal" aria-required="true">

        <label for="ville">Ville : </label>
        <input type="ville" id="ville" name="ville" aria-required="true">

        <label for="pays">Pays : </label>
        <input type="pays" id="pays" name="pays" aria-required="true">

        <label for="telephone">Telephone : </label>
        <input type="telephone" id="telephone" name="telephone" aria-required="true">


        <input type="submit" name="submit" value="Modifier">
    </form>
</article>

<!-- <?php foreach ($userAdresse as $adresse) : ?>
    <?php foreach ($adresse as $a) : ?>
        <p><?= $a ?></p>
    <?php endforeach; ?>
<?php endforeach; ?> -->