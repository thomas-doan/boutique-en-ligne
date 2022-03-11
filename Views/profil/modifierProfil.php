<?php var_dump($_SESSION); ?>
<article>
    <h1>Modifier mon Profil</h1>

    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div><?= $message; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>

    <form action="#" method="post">

        <label for="email">Email : </label>
        <input type="text" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>">

        <label for="nom">Nom : </label>
        <input type="text" id="nom" name="nom" value="<?= $_SESSION['user']['nom'] ?>">

        <label for="prenom">Prenom : </label>
        <input type="text" id="prenom" name="prenom" value="<?= $_SESSION['user']['prenom'] ?>">

        <input type="submit" name="submit" value="Modifier">
    </form>
</article>