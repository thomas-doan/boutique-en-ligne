<article class="container">
    <h1 class="container_title">Connexion</h1>

    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <p class="alert__message"><?= $message; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>

    <form class="form" action="#" method="post">

        <label for="email">Email : </label>
        <input class="form__text" type="text" id="email" name="email">

        <label for="mdp">Mot de passe : </label>
        <input class="form__text" type="password" id="mdp" name="mdp">

        <input class="form__button" type="submit" name="submit" value="Connexion">
    </form>
    <a class="container__link" href="inscription">Je créer un compte</a>
</article>