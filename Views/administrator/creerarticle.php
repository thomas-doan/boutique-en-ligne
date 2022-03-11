<?php var_dump($_SESSION)?>
<section>
    <h3>Admin</h3>
    <ul>
        <li><a href="./partie1">Creer un Article ></a></li>
        <li><a href="../modifierArticle/liste">Modifier un articles ></a></li>
        <li><a href="../gestiondestock">Gestion des stocks ></a></li>
        <li><a href="">Historique de commande ></a></li>
        <li><a href="">Gestion de livraison ></a></li>
        <li><a href="../gestionUtilisateur/liste">Gestion des utilisateurs</a></li>
        <li><a href="../../profil/deconnexion">Se deconnecter</a></li>
    </ul>
</section>
<h3>Creer un Article</h3>
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
<?php if($param == 'partie1') :?>

    <form action="./partie1" method="post" name="info_article_pincipal" enctype="multipart/form-data">
        <fieldset>
            <legend>Informations sur l'article</legend>
            <label for="titre_article"> Nom de l'articles:</label>
            <input type="text" name="titre_article" id="titre_article" value="<?= $Admin_function->coverup_form('titre_article')?>">
            <label for="prix_article"> Prix unitaire:</label>
            <input number="text" step="0.01" name="prix_article" id="prix_article" value="<?= $Admin_function->coverup_form('prix_article')?>">
            <label for="presentation_article">Présentation de l'article :</label>
            <textarea id="presentation_article" name="presentation_article"><?= $Admin_function->coverup_form('presentation_article')?></textarea>
            <label for="description_article">Description de l'article:</label>
            <textarea id="description_article" name="description_article"><?= $Admin_function->coverup_form('description_article')?></textarea>
        </fieldset>
        <fieldset>
            <legend>Ajouter une image</legend>
            <?php $Admin_function->upload_image('image_article','public/assets/pictures/pictures_product/');?>

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

            <label for="image_article">Télécharger une image:</label>
            <input type="file" name="image_article">
            <input type="submit" name="upload_image" value="télécharger">
        </fieldset>
        <fieldset>
            <legend>Information connexe</legend>
            <label for="conditionnement">Preciser le conditionnement de l'article :</label>
            <input type="text" name="conditionnement" id="conditionnement" placeholder="Sachet de 300g" value="<?= $Admin_function->coverup_form('conditionnement')?>">
            <label for="sku">Nombre d'article en stock:</label>
            <input type="number" name="sku" id="sku" value="<?= $Admin_function->coverup_form('sku')?>">
            <label for="fournisseur">Nom du fournisseur:</label>
            <input type="text" name="fournisseur" id="fournisseur" value="<?= $Admin_function->coverup_form('fournisseur')?>">
            <input type="submit" name="etape1" value="Passer à l'étape suivante">
        </fieldset>
    </form>
<?php endif ; ?>

<?php if($param == 'partie2') :?>
    <form action="./partie2" method="post">
        <fieldset>
            <legend>Catégories d'article</legend>
            <label for="PRINCIPALE">Choisir une categorie :</label>
        <?php
        foreach($result_request['principale'] as $value)
        {
            ?>
            <input type="radio" name="PRINCIPALE" id="<?=$value['id_categorie']?>" value="<?=$value['id_categorie']?>">
            <label for="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>      
        </fieldset>
        <fieldset>
            <legend>Variétés & Spécificités</legend>
            <p>Choisir la variété du café et renseigner ses spécificités</p>
            <label for="VARIÉTÉ">Choisir une variété :</label>
        <?php
        foreach($result_request['variete'] as $value)
        {
            ?>
            <input type="radio" name="VARIÉTÉ" id="<?=$value['id_categorie']?>" value="<?=$value['id_categorie']?>">
            <label for="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
            <label for="SPÉCIFICITÉ">Choisir les spécificités :</label>
        <?php
        foreach($result_request['specificite'] as $value)
        {
            ?>
            <input type="checkbox" name="SPÉCIFICITÉ[]" id="<?=$value['id_categorie']?>" value="<?=$value['id_categorie']?>">
            <label for="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>
        <fieldset>
            <legend>Provenence</legend>
            <p>Définir la région originaire du café</p>

            <label for="liste_provenence">Liste des provenences :</label>
            <input list="all_provenence" name="PROVENENCE" id="liste_provenence">
            <datalist id="all_provenence">
            
        <?php
        foreach($result_request['origin'] as $value)
        {
            ?>
                <option value = "<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></option>
            <?php
        }
        ?>
        </datalist>

        <label for="nouvelle_PROVENENCE">Ajouter une nouvelle provenence</label>
        <input type="text" name="nom_PROVENENCE" id="nouvelle_PROVENENCE">
        <input type="submit" name="ajouter_PROVENENCE" value="Ajouter la provenece">

        </fieldset>
        <fieldset>
            <legend>Saveur associé</legend>
            <p>Définissez les différentes saveurs de votre article</p>

            <label for="nouvelle_saveur">Ajouter une nouvelle saveur</label>
            <input type="text" name="nom_SAVEUR" id="nouvelle_saveur">
            <input type="submit" name="ajouter_SAVEUR" value="Ajouter la saveur">
        <?php
        foreach($result_request['flavor'] as $value)
        {
            ?>
            <input type="checkbox" name="SAVEUR[]" id="<?=$value['id_categorie']?>" value="<?=$value['id_categorie']?>">
            <label for="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>
        <fieldset>
            <legend>Force</legend>
            <p>Noter la force du café</p>
        <?php
        foreach($result_request['strong'] as $value)
        {
            ?>
            <input type="radio" name="FORCE" id="<?=$value['id_categorie']?>" value="<?=$value['id_categorie']?>">
            <label for="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>

        <fieldset>
        <p>Filtres selectionnés : </p>
            <?php if(!empty($_SESSION['nouvelarticle']['tag'])):?>
            <?php foreach($_SESSION['nouvelarticle']['tag'] as $key => $value):?>
            <button type="submit" name="delettag" value="<?=$key?>">&#10006; <?=$value?></button>
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

        <input type="submit" name="etape2" value="Visualiser le résultat">
        </form>
         
<?php endif ; ?>


<?php if($param == 'rendu') :?>
        <article>
            <div>
                <h3><?=$_SESSION['nouvelarticle']['etape1']['titre_article']?></h3>
                <p><?=$_SESSION['nouvelarticle']['etape1']['prix_article']?>€</p>
            </div>
            <div>
                <img src="/boutique-en-ligne/public/assets/pictures/pictures_product/<?=$_SESSION['nouvelarticle']['image_article']?>" alt="image de l'article">
                <div>
                    <h4><?=$_SESSION['nouvelarticle']['etape1']['presentation_article']?></h4>
                    <p><?=$_SESSION['nouvelarticle']['etape1']['description_article']?></p>
                    <?=$this->Categories->printAllCategories($_SESSION['nouvelarticle']['etape2'])?>
                    <p><?=$printTag?></p>
                </div>
            </div>
        </article>
        <div>
            <a href="./partie1">Modifier les informations principales</a>
            <a href="./partie2">Modifier les attribues de catégories</a>
            <a href="./upload">Mettre l'article en ligne</a>
        </div>
<?php endif ; ?>
<?php if($param == 'upload') :?>
    <h3><?=$message?></h3>
<?php endif ; ?>