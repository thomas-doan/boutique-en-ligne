<h1>page accueil</h1>


<?php
echo "<pre>";
var_dump($find);

echo "</pre>";

?>



<p> Main accueil</p>
<a href="./exempleid/<?= $value['id_article'] ?>"> lien."<?= $value['id_article'] ?>"
</a>
<?php foreach ($find as $value) { ?>
    <form action="" method="post">

        <label for="id_article">id : </label>
        <input type="text" id="id_article" name="id_article" value="<?= $value['id_article'] ?>">

        <label for="titre_article">titre : </label>
        <input type="text" id="titre_article" name="titre_article" value="<?= $value['titre_article'] ?>">


        <input type="submit" name="submit" value="Modifier">

    </form>


<?php } ?>