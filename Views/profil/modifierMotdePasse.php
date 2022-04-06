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
<article class="form">

    <section class="alert">
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <p class="alert__message"><?= $message; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['flash'])) :  ?>
            <?php unset($_SESSION['flash']) ?>
        <?php endif; ?>
    </section>

    <form class="form__container" action="#" method="post">
        <h1 class="form__title">Modifier mot de passe</h1>

        <div class="form__field">
            <label class="form__label" for="ancienMdp">Ancien mot de passe : </label>
            <input class="form__text" type="text" id="ancienMdp" name="ancienMdp">
        </div>

        <div class="form__field">
            <label class="form__label" for="nouveauMdp">Nouveau mot de passe : </label>
            <input class="form__text" type="text" id="nouveauMdp" name="nouveauMdp">
        </div>

        <div class="form__field">
            <label class="form__label" for="confirmMdp">Validez le nouveau mot de passe : </label>
            <input class="form__text" type="text" id="confirmMdp" name="confirmMdp">
        </div>

        <div class="form__field">
            <input class="form__button" type="submit" name="submit" value="Modifier">
        </div>
    </form>
</article>