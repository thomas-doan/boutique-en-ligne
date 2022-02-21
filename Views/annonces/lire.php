<article>
    <h1><?= $annonce->titre ?></h1>
    <div><?= $annonce->created_at ?></div>
    <div><?= $annonce->description ?></div>
    <?php var_dump($_GET); ?>
    <?php var_dump($_POST); ?>

    <form action="" method="POST">
        <input type="text" name="test">
        <input type="submit">
    </form>

</article>