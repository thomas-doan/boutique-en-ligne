<!-- <section>
    <img src="../public/img/Icon_Profil-test.png" alt="profil picture">
    <h2>Profil</h2>
    <ul>
        <li><a href="./modifierProfil">Modifier mon profil</a></li>
        <li><a href="./modifierMotdePasse">Modifier mon mot de passe</a></li>
        <li><a href="./adresse">Adresse de livraison</a></li>
        <li><a href="./historiqueCommande">Historique de commande</a></li>
        <li><a href="./deconnexion">Se deconnecter</a></li>
    </ul>
</section> -->
<article class="order">
    <div class="order__resume">
    <?php foreach ($order_resume as $key => $order) { ?>

        <section>
            <h1 class="order__title">Commande N°<?= $order['fk_id_num_commande'] ?></h1>
            <p><span>Livrée le : </span><?= $order['date'] ?></p>

            <p><span>Adresse de livraison : </span></p>

            <p><?= $order['voie'] ?></p>
            <p><?= $order['voie_sup'] ?></p>
            <p><?= $order['code_postal'] . ' ' . $order['ville'] ?></p>
        </section>
    <?php break;
    } ?>
    <hr>
    <section>
        <?php foreach ($order_resume as $key => $order) { ?>
            <h2 class="order__title">Article <?= $key + 1 ?></h2>
            <p><span>Article: </span><?= $order['titre_article'] ?></p>
            <p> <span>Quantité: </span><?= $order['nb_article'] ?></p>
            <p><span>Prix: </span><?= $order['prix_article'] ?> € ttc</p>
    </section>
<?php } ?>
<hr>


<section>
    <h2 class="order__title">Prix total</h2>
    <p><span>Total d'articles : </span><?= $order['total_produit'] ?> </p>
    <p><span>Prix total :</span><?= $order['prix_avec_tva'] ?> € ttc</p>
</section>
</div>
</article>