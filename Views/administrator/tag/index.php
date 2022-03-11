<h1>tag CRUD</h1>

<?php if (isset($_SESSION['flash'])) : ?>
    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
        <div><?= $message; ?></div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($_SESSION['flash'])) :  ?>
    <?php unset($_SESSION['flash']) ?>
<?php endif; ?>
<form method="post" name="crudTag">
    <label> Créer un tag</label>
    <input name="nom_tag" placeholder="Nouveau tag" type="text">
    <button name="create_tag" type="submit"> Créer un tag </button>

</form>

<?php foreach ($tag as $value) { ?>

    <label> Tag : </label>

    <form action="" method="post">

        <input name="id_tag" value="<?= $value['id_tag'] ?>" type="hidden">
        <input name="nom_tag" value="<?= $value['nom_tag'] ?>" type="text">
        <button name="update_tag" type="submit"> Modifier tag </button>
        <button name="delete_tag" type="submit"> Suppr tag </button>
    </form>

<?php } ?>