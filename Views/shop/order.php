   <?php if (isset($_SESSION['flash'])) : ?>
       <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
           <div><?= $message; ?></div>
       <?php endforeach; ?>
   <?php endif; ?>

   <?php if (isset($_SESSION['flash'])) :  ?>
       <?php unset($_SESSION['flash']) ?>
   <?php endif; ?>



   <p> c'est la commande de : <?= $info_user[0]['prenom'] ?></p>

   <?php
    foreach ($orderCheck as $key1 => $value1) {
        foreach ($_SESSION['quantite'] as $key2 => $value2) {

            if ($key1 == $key2) { ?>
               Article <?= $value1[0]['titre_article'] ?>, <?= $_SESSION['quantite'][$key1]  ?> Qte = <?php echo $_SESSION['singlePrice'][$key1] ?>euro ;

   <?php
            }
        }
    } ?>
   <p> nombre d'article total : <?php echo $_SESSION['totalQuantity']  ?> </p>
   <p> prix total : <?php echo $_SESSION['totalPrice']  ?> </p>

   <form action="" method="post">
       <input name="submit" type="submit" value="Valider">
       <input name="back" type="submit" value="retour">
   </form>