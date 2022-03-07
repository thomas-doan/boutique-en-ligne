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