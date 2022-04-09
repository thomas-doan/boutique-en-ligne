<article class="mainAndSideAdmin">
    <section class="sideBarreAcount">
        <div>
            <h2>Profil</h2>
            <ul>
                <li><a href="/../boutique-en-ligne/profil/modifierProfil">Modifier mon profil</a></li>
                <li><a href="/../boutique-en-ligne/profil/modifierMotdePasse">Modifier mon mot de passe</a></li>
                <li><a href="/../boutique-en-ligne/profil/adresse">Adresse de livraison</a></li>
                <li><a href="/../boutique-en-ligne/deconnexion">Se deconnecter</a></li>
            </ul>
        </div>
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
</article>