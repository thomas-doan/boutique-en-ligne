   <?php if (isset($_SESSION['flash'])) : ?>
       <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
           <div><?= $message; ?></div>
       <?php endforeach; ?>
   <?php endif; ?>

   <?php if (isset($_SESSION['flash'])) :  ?>
       <?php unset($_SESSION['flash']) ?>
   <?php endif; ?>



   <p> c'est la commande de : <?= $info_user[0]['prenom'] ?></p>

   <p> Vos informations : </p>


   <form action="" method="post">

       <?php

        if (isset($adress)) {

        ?>
           <label> Vos adresses : </label>


           <?php foreach ($adress as $value) { ?>

               <button type="submit" name="id_adresse" value="<?= $value['id_adresse'] ?>"><?= $value['nom_adresse'] ?></button>

           <?php } ?>

       <?php } ?>


       <H3> Contact </H3>

       <label> Prenom : </label>
       <input name="prenom" value="" type="text">

       <label> Nom : </label>
       <input name="nom" value="" type="text">

       <label> Numero de telephone : </label>
       <input name="telephone" value="" type="text">

       <label> Email : </label>
       <input name="email" value="" type="text">

       <H3> Adresse </H3>


       <label> Personnaliser votre adresse : </label>
       <input name="nom_adresse" value="<?php if (isset($_SESSION['select_adress'])) {
                                            $id  = $_SESSION['select_adress'];
                                            echo $adress[$id]['nom_adresse'];
                                        } ?>" type="text">

       <label> libellé : </label>
       <input name="voie" value="<?php if (isset($_SESSION['select_adress'])) {
                                        $id  = $_SESSION['select_adress'];
                                        echo $adress[$id]['voie'];
                                    } ?>" type="text">

       <label> Résidence, appartement, autre : </label>
       <input name="voie_sup" value="<?php if (isset($_SESSION['select_adress'])) {
                                            $id  = $_SESSION['select_adress'];
                                            echo $adress[$id]['voie_sup'];
                                        } ?>" type="text">

       <label> Code Postal : </label>
       <input name="code_postal" value="<?php if (isset($_SESSION['select_adress'])) {
                                            $id  = $_SESSION['select_adress'];
                                            echo $adress[$id]['code_postal'];
                                        } ?>" type="text">

       <label> Ville : </label>
       <input name="ville" value="<?php if (isset($_SESSION['select_adress'])) {
                                        $id  = $_SESSION['select_adress'];
                                        echo $adress[$id]['ville'];
                                    } ?>" type="text">

       <label> Pays : </label>
       <input name="pays" value="<?php if (isset($_SESSION['select_adress'])) {
                                        $id  = $_SESSION['select_adress'];
                                        echo $adress[$id]['pays'];
                                    } ?>" type="text">



       <input name="fk_id_utilisateur" value="<?= $_SESSION['user']['id_utilisateur'] ?>" type="hidden">

       <input name="submit" type="submit" value="Valider">
   </form>