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
<article>
    <section>
        <h1>Commande N°<?= $order['fk_id_num_commande'] ?></h1>
        <p>Livrée le <?= $order['date'] ?></p>
        <p>Adresse de livraison : </p>
        <p><?= $order['voie'] ?></p>
        <p><?= $order['voie_sup'] ?></p>
        <p><?= $order['code_postal'] . ' ' . $order['ville'] ?></p>
    </section>
    <section>
        <h2>Articles</h2>
        <p><?= $order['titre_article'] ?></p>
        <p><?= $order['nb_article'] ?></p>
        <p><?= $order['prix_article'] ?> €</p>
    </section>
    <section>
        <h2>Prix total</h2>
        <p><?= $order['prix_avec_tva'] ?> €</p>
    </section>
</article>