<?php

echo "<br>";
echo "quantite";
echo "<br>";
var_dump($_SESSION['quantite']);
echo "<br>";

var_dump($_SESSION['prix']);
echo "<br>";
?>

<p> c'est le panier </p>

<br>
<?php


if (isset($_SESSION['quantite'])) { ?>

    <?php

    foreach ($articles as $key => $article) {


    ?>
        <form action="" method="post">

            <p> <?= $article['titre_article'] ?> </p>
            <input name="id_article" value="<?= $article['id_article'] ?>" type="hidden">
            <button name="upQuantity" value="1" type="submit"> + </button>
        <?php




    } ?>

        <?php if ($_SESSION['quantite'][$article['id_article']] > 0) { ?>
            <button name="downQuantity" value="1" type="submit"> - </button>
        </form>
    <?php } ?>


    <?php if (isset($_SESSION['quantite'][$article['id_article']])) { ?>

        <form action="" method="post">
            <button name="deleteProduct" type="submit"> supprimer article </button>
            <input name="id_article" value="<?= $article['id_article'] ?>" type="hidden">
        </form>

    <?php } ?>


<?php }
$resultat = 0;
foreach ($_SESSION['quantite'] as $quantite) {
    $resultat = $resultat + $quantite;
}
?>

<p> nombre total d'articles : <?= $resultat ?> </p>

<p>Prix total : <?= $_SESSION['totalPrice']  ?> </p>