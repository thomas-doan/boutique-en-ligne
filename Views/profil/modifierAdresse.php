<section>
    <img src="../public/img/Icon_Profil-test.png" alt="profil picture">
    <h2>Profil</h2>
    <ul>
        <li><a href="./modifierProfil">Modifier mon profil</a></li>
        <li><a href="./modifierMotdePasse">Modifier mon mot de passe</a></li>
        <li><a href="./adresse">Adresse de livraison</a></li>
        <li><a href="./historiqueCommande">Historique de commande</a></li>
        <li><a href="./deconnexion">Se deconnecter</a></li>
    </ul>
</section>
<?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div><?= $message; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>
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

        <input type="submit" name="modifier" value="modifier">
        <input type="submit" name="supprimer" value="supprimer">
    </form>
</article>