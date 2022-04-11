<article class="mainAndSideAdmin">
    <section class="sideBarreAcount">
        <div>
            <h2>Profil</h2>
            <ul>
                <li><a href="/../boutique-en-ligne/profil/modifierProfil">Modifier mon profil</a></li>
                <li><a href="/../boutique-en-ligne/profil/modifierMotdePasse">Modifier mon mot de passe</a></li>
                <li><a href="/../boutique-en-ligne/profil/adresse">Adresse de livraison</a></li>
                <li><a href="/../boutique-en-ligne/profil/historiqueCommande">Historique de commande</a></li>
                <li><a href="/../boutique-en-ligne/deconnexion">Se deconnecter</a></li>
            </ul>
            <?php if ($notifAdresse !== null) : ?>
                <section>
                    <p><?= $notifAdresse ?></p>
                    <a href="profil/adresse">Enregistrer une adresse ></a>
                </section>
            <?php endif; ?>
        </div>
    </section>

</article>