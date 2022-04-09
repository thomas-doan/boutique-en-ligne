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
<article class="historique">
    <h1 class="historique__title">Historique de Commande</h1>
    <section class="historique__field">
        <h2 class="historique__title--small">Commande en cours de livraison</h2>


        <?php foreach ($orders as $order) : ?>

            <section class="historique__fieldState">
                <ul>
                    <li>N°<?= $order['id_num_commande'] ?></li>
                    <li><?= $order['date'] ?></li>
                    <li><?= $order['prix_avec_tva'] ?> €</li>

                    <li><a href="./historiqueCommande/commande/<?= $order['id_num_commande'] ?>">Details > </a></li>
                </ul>
            </section>

        <?php endforeach; ?>
    </section>


</article>