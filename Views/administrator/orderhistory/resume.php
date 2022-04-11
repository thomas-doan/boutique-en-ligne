<article class="mainAndSideAdmin">
    <section class="sideBarreAcount">
        <div>
            <h1>Admin</h1>
            <ul>
                <li><a href="../creerArticle/partie1">Creer un Article</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../modifierArticle/liste">Modifier un articles</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../gestiondestock">Gestion des stocks</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../validercommande"> Gestion de commande</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../categorie">Gestion des categories</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../tag">Gestion des tags</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../commentaire">Gestion des commentaires</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../gestionUtilisateur/liste">Gestion des utilisateurs</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="./../../profil/deconnexion">Se deconnecter</a></li>
            </ul>
        </div>
    </section>

    <div class="containerMain orderHistory">
        <div class="layoutContainertable orderHistory">

            <div>
                <article>
                    <?php foreach ($resume as $key => $order) { ?>
                        <h1>Commande N°<?= $order['fk_id_num_commande'] ?></h1>
                        <section>
                            <h2>Prix total</h2>
                            <p>Nombre total d'articles : <?= $order['total_produit'] ?> </p>
                            <p><?= $order['prix_avec_tva'] ?> € ttc</p>
                        </section>
                        <section>
                            <p>Livrée le <?= $order['date'] ?></p>

                            <p>Adresse de livraison : </p>

                            <p><?= $order['voie'] ?></p>
                            <p><?= $order['voie_sup'] ?></p>
                            <p><?= $order['code_postal'] . ' ' . $order['ville'] ?></p>
                        </section>
                    <?php break;
                    } ?>
                    <?php foreach ($resume as $key => $order) { ?>
                        <h2>Article <?= $key + 1 ?></h2>
                        <section>

                            <p><?= $order['titre_article'] ?></p>
                            <p><?= $order['nb_article'] ?></p>
                            <p><?= $order['prix_article'] ?> € ttc</p>
                        </section>
                    <?php } ?>


                    <a href="./../validercommande"><button class="form__button"> Retour </button></a>

                </article>
            </div>
        </div>
    </div>

</article>