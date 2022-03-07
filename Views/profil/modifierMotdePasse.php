<?php var_dump($_SESSION); ?>
<article>
    <h1>Modifier mot de passe</h1>

    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div><?= $message; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>

    <form action="#" method="post">

        <label for="ancienMdp">Ancien mot de passe : </label>
        <input type="text" id="ancienMdp" name="ancienMdp">

        <label for="nouveauMdp">Nouveau mot de passe : </label>
        <input type="text" id="nouveauMdp" name="nouveauMdp">

        <label for="confirmMdp">Validez le nouveau mot de passe : </label>
        <input type="text" id="confirmMdp" name="confirmMdp">

        <input type="submit" name="submit" value="Modifier">
    </form>
</article>