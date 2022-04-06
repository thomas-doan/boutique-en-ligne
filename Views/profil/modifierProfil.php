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

    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div><?= $message; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>

    <form class="form__container" action="#" method="post">

        <h1 class="form__title">Modifier mon Profil</h1>

        <div class="form__field">
            <label for="email" class="form__label">Email : </label>
            <input class="form__text" type="text" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>">
        </div>

        <div class="form__field">
            <label for="nom" class="form__label">Nom : </label>
            <input class="form__text" type="text" id="nom" name="nom" value="<?= $_SESSION['user']['nom'] ?>">
        </div>

        <div class="form__field">
            <label for="prenom" class="form__label">Prenom : </label>
            <input class="form__text" type="text" id="prenom" name="prenom" value="<?= $_SESSION['user']['prenom'] ?>">
        </div>

        <div class="form__field">
            <input class="form__button" type="submit" name="submit" value="Modifier">
        </div>
    </form>
</article>