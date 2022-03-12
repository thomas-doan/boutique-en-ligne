<h1>tag CRUD</h1>

<?php if (isset($_SESSION['flash'])) : ?>
    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
        <div><?= $message; ?></div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($_SESSION['flash'])) :  ?>
    <?php unset($_SESSION['flash']) ?>
<?php endif; ?>
<form method="post" name="crudComment">
    <label> Créer un commentaire</label>
    <input name="commentaire" placeholder="Votre commentaire" type="text">

    <input list="articles" type="text">
    <datalist id="articles">
        <?php foreach ($articles as $article) {
        ?>

            <option value="<?= $article['titre_article'] ?>">
                <input name="id_article" value="<?= $article['id_article'] ?>" type="hidden">

            <?php } ?>

    </datalist>
    <button name="create_comment" type="submit"> Créer un commentaire </button>

</form>
<h3>Commentaire des admins : </h3>
<?php foreach ($comment as $value) {

    if ($value['role'] == 'Admin') { ?>

        <label> Commentaire : de <?= $value['prenom'] ?> <?= $value['nom'] ?> article <?= $value['titre_article'] ?> </label>

        <form action="" method="post">

            <input name="id_commentaire" value="<?= $value['id_commentaire'] ?>" type="hidden">
            <input name="comment" value="<?= $value['commentaire'] ?>" type="text">
            <button name="update_comment" type="submit"> Modifier commentaire </button>
            <button name="delete_comment" type="submit"> Suppr commentaire </button>
        </form>

<?php }
} ?>

<h3>Commentaire des utilisateurs : </h3>

<?php foreach ($comment as $value) {

    if ($value['role'] == 'Utilisateurs' && $value['signaler'] == 0) { ?>

        <h3>Commentaire des utilisateurs : </h3>
        <label> Commentaire : de <?= $value['prenom'] ?> <?= $value['nom'] ?> article <?= $value['titre_article'] ?> </label>

        <form action="" method="post">

            <input name="id_commentaire" value="<?= $value['id_commentaire'] ?>" type="hidden">
            <input name="comment" value="<?= $value['commentaire'] ?>" type="text">
            <button name="update_comment" type="submit"> Modifier commentaire </button>
            <button name="delete_comment" type="submit"> Suppr commentaire </button>
        </form>
<?php }
} ?>

<h3>Commentaire des utilisateurs signalés : </h3>
<?php foreach ($comment as $value) {
    if ($value['role'] == 'Utilisateurs' && $value['signaler'] == 1) { ?>


        <label> Commentaire : de <?= $value['prenom'] ?> <?= $value['nom'] ?> article <?= $value['titre_article'] ?> </label>

        <form action="" method="post">

            <input name="id_commentaire" value="<?= $value['id_commentaire'] ?>" type="hidden">
            <input name="comment" value="<?= $value['commentaire'] ?>" type="text">
            <button name="update_comment" type="submit"> Modifier commentaire </button>
            <button name="delete_comment" type="submit"> Suppr commentaire </button>
        </form>
<?php }
} ?>