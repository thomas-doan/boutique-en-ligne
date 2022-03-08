<p> c'est la commande de : <?= $info_user['prenom'] ?></p>
<p> Vos informations : </p>






<form action="" method="post">

    <H3> Contact </H3>

    <label> Prenom : </label>
    <input name="prenom" value="" type="text">

    <label> Nom : </label>
    <input name="nom" value="" type="text">

    <label> Numero de telephone : </label>
    <input name="telephone" value="" type="text">

    <H3> Adresse </H3>

    <label> Personnaliser votre adresse : </label>
    <input name="nom_adresse" value="" type="text">

    <label> Adresse : </label>
    <input name="voie" value="" type="text">

    <label> Complement : </label>
    <input name="voie_sup" value="" type="text">

    <label> Code Postal : </label>
    <input name="code_postale" value="" type="text">

    <label> Ville : </label>
    <input name="ville" value="" type="text">

    <label> Pays : </label>
    <input name="pays" value="" type="text">

    <button name="delete_cat" type="submit"> Suppr categorie </button>
</form>



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