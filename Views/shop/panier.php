   <?php

    if (!isset($_SESSION['quantite'])) {
        $_SESSION['quantite']['1'] = 1;
        $_SESSION['quantite']['2'] = 1;
        $_SESSION['quantite']['3'] = 1;
        $_SESSION['quantite']['4'] = 1;
    }

    $resultat = 0;
    ?>


   <p> c'est le panier </p>

   <br>
   <?php



    foreach ($articles as $key => $article) {

    ?>
       <?php var_dump($_SESSION['quantite'][$article['id_article']])  ?>

       <div class="panier">
           <form action="" method="post">
               <p> <?= $article['titre_article'] ?> </p>

               <input name="id_article" value="<?= $article['id_article'] ?>" type="hidden">

               <button name="augmenter" value="1" type="submit"> + </button>
               <?php if ($_SESSION['quantite'][$article['id_article']] > 0) { ?>
                   <button name="diminuer" value="1" type="submit"> - </button>
               <?php } ?>

           </form>

       </div>

   <?php }

    foreach ($_SESSION['quantite'] as $quantite) {
        $resultat = $resultat + $quantite;
    }
    ?>

   <p> <?= $resultat ?> </p>