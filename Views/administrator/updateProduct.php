<a href="./liste">Revenir à la liste</a>
<h3>Modification d'articles</h3>

<?php if($param == 'liste'):?>
<form action="" method="GET">
    <fieldset>
        <legend>Recherche avancée</legend>
        <label for="site-search">Rechercher par nom</label>
        <input type="search" name="recherche" aria-label="Search through site content">
        <button>Search</button>
    </fieldset>
</form>
<form action="<?=$urlRedirect?>" method="POST">
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

<?php if($param !== 'liste'):?>
    <form action="./<?=$param?>" method="post" name="info_article_pincipal" enctype="multipart/form-data">
        <fieldset>
            <legend>Modifier l'image</legend>
            <img src="/boutique-en-ligne/public/assets/pictures/pictures_product/<?=$product['image_article']?>" alt="image du produit">
            <label for="image_article">Télécharger une nouvelle image:</label>
            <input type="file" name="image_article">
            <input type="submit" name="modifimage" value="Modifier l'image">
        </fieldset>
        <fieldset>
            <legend>Informations sur l'article</legend>
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
            
            <br><label for="delet-fk_id_categorie">Quelle variété souhaitez-vous supprimer de l'artcle ?</label>
                <?php foreach($CatOfProduct['variete'] as $value):?>
                    <button type="submit" name="delet-fk_id_categorie" value="<?=$value['id_categorie']?>">&#10006; <?=$value['nom_categorie']?></button>
                <?php endforeach;?> 
            <br><label for="add-fk_id_categorie">Quelle variété souhaitez-vous ajouter de l'artcle ?</label>
                <?php foreach($AllCat['variete'] as $value) :?>
                    <button type="submit" name="add-fk_id_categorie" value="<?=$value['id_categorie']?>">&#10010; <?=$value['nom_categorie']?></button>
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
    </form>
<?php endif;?>
