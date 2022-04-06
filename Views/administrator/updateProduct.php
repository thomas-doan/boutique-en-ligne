<article class="mainAndSideAdmin">
<section class="sideBarreAcount">
    <div>
    <h3>Admin</h3>
        <ul>
            <li><a href="../creerArticle/partie1">Creer un Article ></a></li>
            <li><a href="../modifierArticle/liste">Modifier un articles ></a></li>
            <li><a href="../gestiondestock">Gestion des stocks ></a></li>
            <li><a href="">Historique de commande ></a></li>
            <li><a href="">Gestion de livraison ></a></li>
            <li><a href="../gestionUtilisateur/liste">Gestion des utilisateurs</a></li>
            <li><a href="../../profil/deconnexion">Se deconnecter</a></li>
        </ul>
    </div>
</section>
<section>
    <h3>Modification d'articles</h3>

    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div><?= $message; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>
    <?php if(!empty($erreur)):?>
    <p><?=$erreur?></p>
    <?php endif;?>

<?php if($param == 'liste'):?>
<section class="formSearchUpdateProduct">
<form action="" method="GET">
    <fieldset>
        <legend>Recherche avancée</legend>
        <label for="site-search">Rechercher par nom</label>
        <input type="search" name="recherche" aria-label="Search through site content">
        <button>Search</button>
    </fieldset>
</form>
<form action="" method="POST">
<label for="PRINCIPALE ">Trier par Catégories Principales</label>
        <select list="list_categories" name="PRINCIPALE" id="list_categories">
            <datalist id="list_categories">
                <option></option>
                <?php foreach($allCategories as $value):?>
                    <option value = "<?=$value['nom_categorie']?>"><?=$value['nom_categorie']?>(<?=$methodImport->countSearch($value['nom_categorie'])?>)</option>
                <?php endforeach;?>
            </datalist>
        </select>
        <input type="submit" value='appliquer'>
</form>
</section>

<table>
    <thead>
        <tr>Nom de l'Article</tr>
        <tr>Catégorie Principale</tr>
        <tr>Prix</tr>
        <tr>selectionner</tr>
    </thead>
    <tbody>
        <?php foreach($resultSearch as $value) :?>
        <tr>
            <td><?=$value['titre_article']?></td>
            <td><?=$value['cat parent']?></td>
            <td><?=$value['prix_article']?></td>
            <td><a href="./<?=$value['id_article']?>"><button>Modifier</button></a></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php endif;?>
</section>

<?php if($param !== 'liste'):?>
    <a href="./liste">Revenir à la liste</a>
    <form action="#formProduct" method="post" name="info_article_pincipal" enctype="multipart/form-data">
        <fieldset>
            <legend>Modifier l'image</legend>
            <img src="/boutique-en-ligne/public/assets/pictures/pictures_product/<?=$product['image_article']?>" alt="image du produit">
            <label for="image_article">Télécharger une nouvelle image:</label>
            <input type="file" name="image_article">
            <input type="submit" name="modifimage" value="Modifier l'image">
        </fieldset>
        <fieldset>
            <legend id="formProduct">Informations sur l'article</legend>
            <label for="titre_article"> Nom de l'articles:</label>
            <input type="text" name="titre_article" id="titre_article" value="<?=$product['titre_article']?>">
            <label for="prix_article"> Prix unitaire:</label>
            <input number="text" step="0.01" name="prix_article" id="prix_article" value="<?=$product['prix_article']?>">
            <label for="presentation_article">Présentation de l'article :</label>
            <textarea id="presentation_article" name="presentation_article"><?=$product['presentation_article']?></textarea>
            <label for="description_article">Description de l'article:</label>
            <textarea id="description_article" name="description_article" ><?=$product['description_article']?></textarea>
            <label for="conditionnement">Preciser le conditionnement de l'article :</label>
            <input type="text" name="conditionnement" id="conditionnement" placeholder="Sachet de 300g" value="<?=$product['conditionnement']?>">
            <label for="sku">Nombre d'article en stock:</label>
            <input type="number" name="sku" id="sku" value="<?=$product['sku']?>">
            <label for="fournisseur">Nom du fournisseur:</label>
            <input type="text" name="fournisseur" id="fournisseur" value="<?=$product['fournisseur']?>">
            <input type="submit" name="modifInformations" value="Modifier">
        </fieldset>
    </form>
    <form id="categorie" action="#categorie" method="post">
        <fieldset>
            <legend>Ajouter ou Suprimer une categorie</legend>
            <p>Catégorie Principale actuelle de l'article : <b><?= $CatOfProduct['mainCat']['nom_categorie']?></b></p>
            <label for="id_parent">Changer la categorie principale de l'article par</label>
                <?php foreach($AllCat['principale'] as $value) :?>
                    <button type="submit" name="id_parent" value="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></button>
                <?php endforeach;?>

                <p>Origine actuelle du café :  <b><?=$CatOfProduct['origin'][0]['nom_categorie']?></b></p>
                <?php foreach($AllCat['origin'] as $value) :?>
                    <button type="submit" name="PROVENENCE" value="<?=$value['id_categorie']?>">&#10010; <?=$value['nom_categorie']?></button>
                <?php endforeach;?>

            <br><p>La force de actuel du produit est estimé à : <b><?=$CatOfProduct['strong'][0]['nom_categorie']?></b></p>
            <br><label for="FORCE">Réévaluer sa force à :</label>
                <?php foreach($AllCat['strong'] as $value) :?>
                    <button type="submit" name="FORCE" value="<?=$value['id_categorie']?>">&#10010; <?=$value['nom_categorie']?></button>
                <?php endforeach;?>
            
            <br><p>La variété actuelle du produit est : <b><?=$CatOfProduct['variete'][0]['nom_categorie']?></b></p>
            <br><label for="VARIÉTÉ">Modifier sa variété :</label>
                <?php foreach($AllCat['variete'] as $value) :?>
                    <button type="submit" name="VARIÉTÉ" value="<?=$value['id_categorie']?>">&#10010; <?=$value['nom_categorie']?></button>
                <?php endforeach;?>
            
            <br><label for="delet-fk_id_categorie">Quelle spécifité souhaitez-vous supprimer de l'artcle ?</label>
                <?php foreach($CatOfProduct['specificite'] as $value):?>
                    <button type="submit" name="delet-fk_id_categorie" value="<?=$value['id_categorie']?>">&#10006; <?=$value['nom_categorie']?></button>
                <?php endforeach;?> 
            <br><label for="add-fk_id_categorie">Quelle spécifité souhaitez-vous ajouter de l'artcle ?</label>
                <?php foreach($AllCat['specificite'] as $value) :?>
                    <button type="submit" name="add-fk_id_categorie" value="<?=$value['id_categorie']?>">&#10010; <?=$value['nom_categorie']?></button>
                <?php endforeach;?>
            
            <br><label for="delet-fk_id_categorie">Quelle saveur souhaitez-vous supprimer de l'artcle ?</label>
                <?php foreach($CatOfProduct['flavor'] as $value):?>
                    <button type="submit" name="delet-fk_id_categorie" value="<?=$value['id_categorie']?>">&#10006; <?=$value['nom_categorie']?></button>
                <?php endforeach;?> 
            <br><label for="add-fk_id_categorie">Quelle saveur souhaitez-vous ajouter de l'artcle ?</label>
                <?php foreach($AllCat['flavor'] as $value) :?>
                    <button type="submit" name="add-fk_id_categorie" value="<?=$value['id_categorie']?>">&#10010; <?=$value['nom_categorie']?></button>
                <?php endforeach;?>

        </fieldset>

        <fieldset>
        <p>Filtres selectionnés : </p>
            <?php if($tagOfProduct):?>
            <?php foreach($tagOfProduct as $key => $value):?>
            <button type="submit" name="delettag" value="<?=$value['fk_id_tag']?>">&#10006; <?=$value['nom_tag']?></button>
            <?php endforeach;
            endif ;?>

            <legend>Tags</legend>
            <p>Ajouter des tags :</p>

            <label for="liste_tag">Liste des tags :</label>
            <input list="all_tag" name="tag" id="liste_tag">
            <datalist id="all_tag">
        <?php
        foreach($allTags as $value)
        {
            ?>
                <option value = "<?=$value['nom_tag']?>"><?=$value['nom_tag']?></option>
            <?php
        }
        ?>
        </datalist>
        <input type="submit" name="addTag" value="ajouter">
        </fieldset>
    </form>
<?php endif;?>
</article>
