<!-- <?php var_dump($product);?> -->
<!-- <?php var_dump($categories);?> -->
<!-- <?php var_dump($comments);?> -->
<!-- <?php var_dump($CatOfProduct); ?> -->
<!-- <?php var_dump($likes);?> -->
<?php var_dump($_SESSION);?>
<article>
    <h1><?= $product[0]['titre_article']?></h1>
    <img src="../public/assets/pictures/pictures_product/<?=$product[0]['image_article']?>" alt="Image du produit">
    <div>
        <form action="" method="post">
            <button type="submit" name="like"><img src="../public/img/Icon_Like-test.png" alt="Icon like"></button>
        </form>
        <p><?=$likes?></p>
    </div>
    <p><?= $product[0]['prix_article']?>€</p>
    <ul>
        <li>Provenence : <?=$CatOfProduct['origin'][0]['nom_categorie'] ?></li>
        <li>Type : <?=$CatOfProduct['variete'][0]['nom_categorie'] ?></li>
        <li>Saveur : 
            <?php foreach($CatOfProduct['flavor'] as $key => $flavors): ?>
                <?=$flavors['nom_categorie']?>
            <?php endforeach ;?>
        </li>
    </ul>
</article>
<article>
    <h2>Caroussel</h2>
</article>

<article>
    <h2>Commentaires</h2>
    <?php foreach($comments as $comment):?>
    <section>
        <h3><?= $comment['prenom'] . ' '. $comment['nom']?></h3>
        <p><?= $comment['commentaire']?></p>
    </section>
    <?php endforeach ;?>
    <section>
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div><?= $message; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['flash'])) :  ?>
            <?php unset($_SESSION['flash']) ?>
        <?php endif; ?>
        <form action="#" method="POST">
            <label for="comment" style="display: none">Ecrire un commentaire</label>
            <input type="text" id="comment" name="com" placeholder="Laissez votre commentaire ...">
            <input type="submit" name="submit" value="Ecrire un commentaire">
        </form>
    </section>
</article>