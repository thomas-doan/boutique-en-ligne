<article class="form">
    <h1 class="form__title">Connexion</h1>

    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <p class="alert__message"><?= $message; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>

    <form class="form__container" action="#" method="post">
        <div class="form__field">
            <label for="email">Email : </label>
            <input class="form__text" type="text" id="email" name="email">
        </div>
        <div class="form__field">
            <label for="mdp">Mot de passe : </label>
            <input class="form__text" type="password" id="mdp" name="mdp">
        </div>

        <div class="form__field">
            <input class="form__button" type="submit" name="submit" value="Connexion">
        </div>

    </form>
    <a href="checkemail">Mot de passe oublié ?</a>
    <a class="form__link" href="inscription">Je créer un compte</a>
</article>