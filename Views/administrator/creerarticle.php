<?php
var_dump($_POST);
var_dump($_SESSION);
var_dump($error);

?>
    <p><?=$error?></p>
<?php if($param == 'partie1') :?>

    <form action="<?=$url_action?>" method="post" name="info_article_pincipal" enctype="multipart/form-data">
        <fieldset>
            <legend>Informations sur l'article</legend>
            <label for="titre_article"> Nom de l'articles:</label>
            <input type="text" name="titre_article" id="titre_article" value="<?= $Admin_function->coverup_form('titre_article')?>">
            <label for="prix_article"> Prix unitaire:</label>
            <input number="text" step="0.01" name="prix_article" id="prix_article" value="<?= $Admin_function->coverup_form('prix_article')?>">
            <label for="presentation_article">Présentation de l'article :</label>
            <textarea id="presentation_article" name="presentation_article">
                <?= $Admin_function->coverup_form('presentation_article')?>
            </textarea>
            <label for="description_article">Description de l'article:</label>
            <textarea id="description_article" name="description_article">
                <?= $Admin_function->coverup_form('description_article')?>
            </textarea>
        </fieldset>
        <fieldset>
            <legend>Ajouter une image</legend>
            <?php $Admin_function->upload_image('../public/assets/images/', 'image_article');?>
            <label for="image_article">Télécharger une image:</label>
            <input type="file" name="image_article">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" title="Permitted bytes per file." />
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
    <form action="./administrator/partie2" method="post">
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

        <input type="submit" name="etape2" value="Visualiser le résultat">
        </form>
         

<?php endif ; ?>