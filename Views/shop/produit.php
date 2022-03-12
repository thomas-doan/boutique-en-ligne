<!-- <?php var_dump($_SESSION); ?> -->
<!-- <?php var_dump($product); ?> -->
<!-- <?php var_dump($categories); ?> -->
<!-- <?php var_dump($comments); ?> -->
<!-- <?php var_dump($CatOfProduct); ?> -->
<!-- <?php var_dump($likes); ?> -->

<article>
    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div><?= $message; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>
    <h1><?= $product[0]['titre_article'] ?></h1>
    <img src="../public/assets/pictures/pictures_product/<?= $product[0]['image_article'] ?>" alt="Image du produit">
    <div>
        <form action="#like" method="post">
            <button type="submit" name="like" id="like"><img src="../public/img/Icon_Like-test.png" alt="Icon like"></button>
        </form>
        <p><?= $likes ?></p>
    </div>
    <p><?= $product[0]['prix_article'] ?>€</p>
    <ul>
        <li>Provenence : <?= $CatOfProduct['origin'][0]['nom_categorie'] ?></li>
        <li>Type : <?= $CatOfProduct['variete'][0]['nom_categorie'] ?></li>
        <li>Saveur :
            <?php foreach ($CatOfProduct['flavor'] as $key => $flavors) : ?>
                <?= $flavors['nom_categorie'] ?>
            <?php endforeach; ?>
            <!-- <?php implode(',', $CatOfProduct['flavor']); ?> -->
        </li>
    </ul>
    <section>
        <p> nombre de commentaire : <?= $numberOfComment ?></p>
        <a href="#comment">Voir les commentaires</a>
        <form action="" method="post">
            <label for="addBasket"></label>
            <input type="hidden" name="id_article" value="<?= $product[0]['id_article'] ?>"></input>
            <input type="hidden" name="prix_article" value="<?= $product[0]['prix_article'] ?>"></input>
            <input type="submit" id="addBasket" name="add" value="AJOUTER AU PANIER >">
        </form>
    </section>
</article>
<article>
    <h2>Caroussel</h2>
</article>

<article>
    <h2>Commentaires</h2>
    <?php

    foreach ($comments as $key => $comment) {
        $NbrOfIndex = count($comment);
        $NbrOfIndex = $NbrOfIndex - 6;
    ?>
        <section>
            <h3><?= $comment['prenom'] . ' ' . $comment['nom'] ?></h3>
            <p><?= $comment['commentaire'] ?></p>
            <p><?= $comment['date'] ?></p>
        </section>
        <section>
            <form action="" method="POST">
                <input type="hidden" id="comment" name="id_commentaire" value="<?= $comment['id_commentaire'] ?>">

                <input type="text" id="comment" name="comment" placeholder="Répondre au commentaire" value="">
                <input type="submit" name="submitAnswer" value="ok">
            </form>
        </section>
        <?php
        for ($i = 0; $i < $NbrOfIndex; $i++) {
            if ($comment['fk_id_commentaire'] == $comment['id_commentaire']) {

        ?>
                <section>

                    <h3> réponse par : <?= $comment[$i]['reponse_nom'] . ' ' . $comment[$i]['reponse_prenom'] ?></h3>
                    <p> commentaire : <?= $comment[$i]['reponse_assoc'] ?></p>
                    <p> date : <?= $comment[$i]['reponse_date'] ?></p>

                </section>


    <?php
            }
        }
    }

    ?>



    <section>
        <form action="" method="POST">
            <label for="comment" style="display: none">Ecrire un commentaire</label>
            <input type="text" id="comment" name="com" placeholder="Laissez votre commentaire ...">
            <input type="submit" name="submit" value="Ecrire un commentaire">
        </form>
    </section>
</article>