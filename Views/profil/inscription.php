<article class="container">

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
    
    
    <form class="form" action="" method="post">

        <h1 class="container__title">Inscription</h1>
        <div class="form__field">

            <label class="form__label" for="prenom">Prenom :</label>
            <input class="form__text" type="text" id="prenom" name="prenom" aria-required="true">
        </div>

        <div class="form__field">

        <label for="email">Ecrire votre question secrete :</label>
        <input type="text" id="email" name="question_secrete" aria-required="true">

        <label for="email">reponse :</label>
        <input type="password" id="email" name="reponse" aria-required="true">

        <label for="mdp">Mot de passe : </label>
        <input type="password" id="mdp" name="mdp" aria-required="true">
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
            
            <input class="form__button" type="submit" name="submit" value="Inscription">
        </div>
        <a class="container__link" href="connexion">J'ai déjà un compte ></a>
    </form>

</article>