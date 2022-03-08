<p> c'est la commande de : <?= $info_user['prenom'] ?></p>


<?php foreach ($orderCheck as $key1 => $value1) {
    foreach ($_SESSION['quantite'] as $key2 => $value2) {
        if ($key1 == $key2) { ?>
            Article <?= $value1['titre_article'] ?>, <?= $_SESSION['quantite'][$key1]  ?> Qte = <?php echo $_SESSION['singlePrice'][$key1] ?>euro ;

<?php
        }
    }
} ?>
<p> prix total : <?php echo $_SESSION['totalPrice']  ?> </p>

<form action="" method="post">
    <input name="fk_id_utilisateur" value="$_SESSION['fk_id_utilisateur']" type="hidden">
    <input name="order" type="submit" value="payer">
</form>