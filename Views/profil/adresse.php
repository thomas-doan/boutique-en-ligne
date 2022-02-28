<article>
    <h1>Adresse de Livraison</h1>

    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div><?= $message; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- <?php session_destroy(); ?> -->

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>


    <form action="" method="post">
        <label for="prenom">Prenom :</label>
        <input type="text" id="prenom" name="prenom" aria-required="true">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" aria-required="true">

        <label for="email">Email :</label>
        <input type="text" id="email" name="email" aria-required="true">

        <label for="mdp">Mot de passe : </label>
        <input type="password" id="mdp" name="mdp" aria-required="true">

        <label for="mdpConfirm">Confirmez votre mot de Passe :</label>
        <input type="password" id="mdpConfirm" name="mdpConfirm" aria-required="true">

        <input type="submit" name="submit" value="Inscription">
    </form>
</article>