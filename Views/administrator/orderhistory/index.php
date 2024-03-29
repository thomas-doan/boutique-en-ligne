<article class="mainAndSideAdmin">
    <section class="sideBarreAcount">
        <div>
            <h1>Admin</h1>
            <ul>
                <li><a href="./creerArticle/partie1">Creer un Article</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="./modifierArticle/liste">Modifier un articles</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="./gestiondestock">Gestion des stocks</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="./validercommande"> Gestion de commande</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="./categorie">Gestion des categories</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="./tag">Gestion des tags</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="./commentaire">Gestion des commentaires</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="./gestionUtilisateur/liste">Gestion des utilisateurs</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../profil/deconnexion">Se deconnecter</a></li>
            </ul>
        </div>
    </section>
    <div class="containerMain orderHistory">

        <div class="layoutContainertable orderHistory">

            <div>
                <article>

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

                    <section>
                        <?php

                        foreach ($livraison as $value) {

                            if ($value['etat_livraison'] == "en attente confirmation") {

                        ?>
                                <form action="" method="post">

                                    <p>Num Commande : <?= $value['fk_id_num_commande'] ?></p>
                                    <p>Date : <?= $value['date'] ?></p>
                                    <p>Nombre total d'articles : <?= $value['total_produit'] ?></p>
                                    <p>Prix total : <?= $value['prix_avec_tva'] ?>€</p>
                                    <p>Par <?= $value['prenom'] ?> <?= $value['nom'] ?> email : <?= $value['email'] ?> </p>
                                    <input name="id_livraison" class="form__label" value="<?= $value['id_livraison'] ?>" type="hidden">
                                    <button class="form__button" name="submit" type="submit"> Valider </button>
                                </form>
                        <?php }
                        } ?>
                    </section>
                    <label>
                        <h2>Commandes passées : </h2>
                    </label>
                    <section>
                        <?php

                        foreach ($livraison as $value) {

                            if ($value['etat_livraison'] == "confirme") {
                        ?>

                                <p>Num Commande : <?= $value['fk_id_num_commande'] ?></p>
                                <p>Date : <?= $value['date'] ?></p>
                                <p>Nombre total d'articles : <?= $value['total_produit'] ?></p>
                                <p>Prix total : <?= $value['prix_avec_tva'] ?>€</p>
                                <p>Par <?= $value['prenom'] ?> <?= $value['nom'] ?> email : <?= $value['email'] ?> </p>
                                <a href="./detail/<?= $value['fk_id_num_commande'] ?>"><button class="form__button"> Voir Détail </button></a>

                        <?php  }
                        } ?>

                    </section>


                </article>
            </div>
        </div>


</article>