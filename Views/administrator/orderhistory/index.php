    <ul>
        <li><a href="./creerArticle/partie1">Creer un Article ></a></li>
        <li><a href="./modifierArticle/liste">Modifier un articles ></a></li>
        <li><a href="./gestiondestock">Gestion des stocks ></a></li>

        <li><a href="./commentaire">Gestion des commentaires ></a></li>
        <li><a href="./categorie">Gestion des catégories ></a></li>
        <li><a href="./gestionUtilisateur/liste">Gestion des utilisateurs ></a></li>
        <li><a href="profil/deconnexion">Se deconnecter</a></li>
    </ul>




    <h1>Valider les commandes</h1>

    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div><?= $message; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>

    <label>
        <h2>Commande en attente : <?= $nb['nb'] ?></h2>
    </label>
    <?php


    foreach ($livraison as $value) {

        if ($value['etat_livraison'] == "en attente confirmation") {

    ?>


            <form action="" method="post">

                <p>Num Commande : <?= $value['fk_id_num_commande'] ?></p>
                <p>Date : <?= $value['date'] ?></p>
                <p>Nombre total d'articles : <?= $value['nb_article'] ?></p>
                <p>Prix total : <?= $value['prix_commande'] ?>€</p>
                <p>Par <?= $value['prenom'] ?> <?= $value['nom'] ?> email : <?= $value['email'] ?> </p>
                <input name="id_livraison" value="<?= $value['id_livraison'] ?>" type="hidden">
                <button name="submit" type="submit"> Valider la commande </button>
            </form>


    <?php }
    } ?>
    <label>
        <h2>Commandes passées : </h2>
    </label>

    <?php


    foreach ($livraison as $value) {


        if ($value['etat_livraison'] == "confirme") {
    ?>



            <form action="" method="post">

                <p>Num Commande : <?= $value['fk_id_num_commande'] ?></p>
                <p>Date : <?= $value['date'] ?></p>
                <p>Nombre total d'articles : <?= $value['nb_article'] ?></p>
                <p>Prix total : <?= $value['prix_commande'] ?>€</p>
                <p>Par <?= $value['prenom'] ?> <?= $value['nom'] ?> email : <?= $value['email'] ?> </p>

            </form>


    <?php }
    } ?>