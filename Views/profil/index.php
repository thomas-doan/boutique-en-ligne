<article>
    <section class="alert">
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div><?= $message; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['flash'])) :  ?>
            <?php unset($_SESSION['flash']) ?>
        <?php endif; ?>
    </section>
    <section>
        <h1><?= ucfirst(@$_SESSION['user']['prenom']) . ' ' . ucfirst(@$_SESSION['user']['nom']); ?></h1>
        <p><?= @$_SESSION['user']['email'] ?></p>
    </section>
    <section>
        <img src="public/img/Icon_Profil-test.png" alt="profil picture">
        <h2>Profil</h2>
        <ul>
            <li><a href="profil/modifierProfil">Modifier mon profil</a></li>
            <li><a href="profil/modifierMotdePasse">Modifier mon mot de passe</a></li>
            <li><a href="profil/adresse">Adresse de livraison</a></li>
            <li><a href="profil/historiqueCommande">Historique de commande</a></li>
            <li><a href="profil/deconnexion">Se deconnecter</a></li>
        </ul>
    </section>
    <?php if($notifAdresse !== null):?>
    <section>
        <p><?=$notifAdresse?></p>
        <a href="profil/adresse">Enregistrer une adresse ></a>
    </section>
    <?php endif;?>

</article>