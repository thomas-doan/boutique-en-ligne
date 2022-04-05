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


    <form class="form__container" action="" method="post">

        <h1 class="form__title">Inscription</h1>

        <div class="form__field">
            <label class="form__label" for="prenom">Prenom :</label>
            <input class="form__text" type="text" id="prenom" name="prenom" aria-required="true">
        </div>

        <div class="form__field">
            <label class="form__label" for="nom">Nom :</label>
            <input class="form__text" type="text" id="nom" name="nom" aria-required="true">
        </div>

        <div class="form__field">
            <label class="form__label" for="email">Email :</label>
            <input class="form__text" type="text" id="email" name="email" aria-required="true">
        </div>


        <div class="form__field">
            <label class="form__label" for="mdp">Mot de passe : </label>
            <input class="form__text" type="password" id="mdp" name="mdp" aria-required="true">
        </div>

        <div class="form__field">
            <label class="form__label" for="mdpConfirm">Confirmez votre mot de Passe :</label>
            <input class="form__text" type="password" id="mdpConfirm" name="mdpConfirm" aria-required="true">
        </div>

        <div class="form__field">
            <label for="question" class="form__label">Ecrire votre question secrete :</label>
            <input type="text" id="question" name="question_secrete" aria-required="true" class="form__text">
        </div>

        <div class="form__field">
            <label for="reponse" class="form__label">Reponse :</label>
            <input type="password" id="reponse" name="reponse" aria-required="true" class="form__text">
        </div>

        <div class="form__field">

            <input class="form__button" type="submit" name="submit" value="Inscription">
        </div>
        <a class="form__link" href="connexion">J'ai déjà un compte ></a>
    </form>

</article>