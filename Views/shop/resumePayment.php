        <?php
        if (!isset($_SESSION['num_commande'])) {
            header('Location: /boutique-en-ligne/');
        }
        ?>


        <div class="containerMain">
            <article class="formLivraison paiementResume">
                <section class="formField paimentResume">

                    <h1>Votre commande est bien effectuée, merci de votre confiance.</h1>

                    <h2>Recapitulatif commande : </h2>


                    <?php foreach ($commande as $key => $value) { ?>
                        <div>
                            <p>Article : <?= $value['titre_article'] ?></p>
                            <p>Nombre d'unité achetée : <?= $value['nb_article'] ?></p>
                            <p>Prix unitaire : <?= $value['prix_article'] ?></p>
                            <p>Prix total : <?= $value['prix_commande'] ?></p>

                        </div>
                    <?php  } ?>
                    <?php foreach ($commande as $key => $value) {

                        if ($value['total_produit'] > 1) { ?>
                            <p>Nombre total de produits achetés : <?= $value['total_produit'] ?></p>

                            <p>Prix ttc : <?= $value['prix_avec_tva'] ?> </p>
                        <?php }  ?>

                    <?php break;
                    } ?>

                    <?php if (isset($_SESSION['halfQuantityPayment'])) {
                        $valueHalfQuantity = $_SESSION['halfQuantityPayment'];
                        foreach ($valueHalfQuantity as $valueHalf) { ?>
                            <p> Malheureusement, le stock était de <?= $valueHalf[0] ?> pour l'article <?= $valueHalf[1] ?> </p>

                        <?php } ?>

                    <?php } ?>
                    <a href="/boutique-en-ligne"> <button class="form__button">retour</button></a>

                </section>
            </article>
        </div>

        <?php
        unset($_SESSION['halfQuantityPayment']);
        unset($_SESSION['num_commande']);
        unset($_SESSION['totalQuantity']);
        ?>