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
    <H1>Historique de Commande</H1>
    <section>
        <h2>Commande en cours de livraison</h2>
        <?php foreach ($orders as $order) : ?>
            <?php if ($order['etat_commande'] === "En cours de livraison") : ?>
                <section>
                    <ul>
                        <li>N°<?= $order['num_commande'] ?></li>
                        <li><?= $order['date_commande'] ?></li>
                        <li><?= $order['prix_total'] ?> €</li>
                        <li><a href="./historiqueCommande/commande/<?= $order['id_commande'] ?>">Details > </a></li>
                    </ul>
                </section>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>

    <section>
        <h2>Commande livrées</h2>
        <?php foreach ($orders as $order) : ?>
            <?php if ($order['etat_commande'] === "Commande livrées") : ?>
                <section>
                    <ul>
                        <li>N°<?= $order['num_commande'] ?></li>
                        <li><?= $order['date_commande'] ?></li>
                        <li><?= $order['prix_total'] ?> €</li>
                        <li><a href="./historiqueCommande/commande/<?= $order['id_commande'] ?>">Details > </a></li>
                    </ul>
                </section>
            <?php endif; ?>
        <?php endforeach; ?>
    </section>
</article>