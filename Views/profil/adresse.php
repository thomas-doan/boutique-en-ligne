<?php var_dump($_SESSION); ?>
<article>
    <h1>Adresse de Livraison</h1>
    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div><?= $message; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>
    <section>

        <?php for ($i = 0; $i <= 2; $i++) : ?>
            <?php if (isset($userAdress[$i])) : ?>
                <p><?= $userAdress[$i]['nom_adresse'] ?></p>
                <button><a href="./adresse/modifierAdresse/<?= $userAdress[$i]['id_adresse'] ?>">Modifier</a></button><br>
            <?php else : ?>
                <a href="./adresse/creerAdresse">Nouvelle adresse</a>
            <?php endif; ?>
        <?php endfor; ?>

    </section>

    <?php if (count($userAdress) < 3) : ?>
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
            <input type="text" id="libelle" name="libelle" aria-required="true">

            <label for="voieSup">Voie Sup : </label>
            <input type="text" id="voieSup" name="voieSup" aria-required="true">

            <label for="codePostal">Code Postal : </label>
            <input type="number" id="codePostal" name="codePostal" aria-required="true">

            <label for="ville">Ville : </label>
            <input type="text" id="ville" name="ville" aria-required="true">

            <label for="pays">Pays : </label>
            <input type="text" id="pays" name="pays" aria-required="true">

            <label for="telephone">Telephone : </label>
            <input type="number" id="telephone" name="telephone" aria-required="true">


            <input type="submit" name="submit" value="Ajouter">
        </form>
    <?php endif; ?>

</article>