<section>
    <ul>
        <li><a href="./Dosette">Dosette</a></li>
        <li><a href="./Moulu">Moulu</a></li>
        <li><a href="./Grain">Grain</a></li>
    </ul>
</section>
<?php if(!empty($erreur)):?>
<h4><?=$erreur?></h4>
<?php endif;?>

<?php if(isset($resultFilter)):?>
<section>
    <form action="" method="post">
    <p>Filtres selectionnés : </p>
    <?php foreach($resultFilter as $key => $value):?>
        <?php if(is_array($value)):?>
        <?php foreach($value as $underkey => $underValue):?>
            <button type="submit" name="deletFilter" value="<?=$key?>-<?=$underkey?>-<?=$underValue?>">&#10006; <?=$underValue?></button>
        <?php endforeach;?>
        <?php else :?>
         <button type="submit" name="deletFilter" value="<?=$key?>-<?=$value?>">&#10006; <?=$value?></button>
        <?php endif ;?>
    <?php endforeach; ?>
    </form>
</section>
<?php endif ;?>

<h3>Boutique</h3>

<section>
<form action="" method="post">
        <h4>Recherche avancer</h4>
        <fieldset>
            <legend>Variétés & Spécificités</legend>
            <label for="VARIÉTÉ">variété :</label>
        <?php
        foreach($result_request['variete'] as $value)
        {
            ?>
            <input type="radio" name="VARIÉTÉ" id="<?=$value['nom_categorie']?>" value="<?=$value['nom_categorie']?>">
            <label for="<?=$value['nom_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>
        <fieldset>
            <legend>Provenence :</legend>
            
        <?php
        foreach($result_request['origin'] as $value)
        {
            ?>
            <input type="radio" name="PROVENENCE" id="<?=$value['nom_categorie']?>" value="<?=$value['nom_categorie']?>">
            <label for="<?=$value['nom_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>
        <fieldset>
            <legend>Spécificités :</legend>
        <?php
        foreach($result_request['specificite'] as $value)
        {
            ?>
            <input type="checkbox" name="SPÉCIFICITÉ[]" id="<?=$value['nom_categorie']?>" value="<?=$value['nom_categorie']?>">
            <label for="<?=$value['nom_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>
        <fieldset>
            <legend>Saveur :</legend>
        <?php
        foreach($result_request['flavor'] as $value)
        {
            ?>
            <input type="checkbox" name="SAVEUR[]" id="<?=$value['nom_categorie']?>" value="<?=$value['nom_categorie']?>">
            <label for="<?=$value['nom_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>
        <fieldset>
            <legend>Force :</legend>
        <?php
        foreach($result_request['strong'] as $value)
        {
            ?>
            <input type="radio" name="FORCE" id="<?=$value['nom_categorie']?>" value="<?=$value['nom_categorie']?>">
            <label for="<?=$value['nom_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>

        <input type="submit" name="filtre" value="Filtrer">
        </form>
</section>

<section class="boutique">
    <?php for ($firstProduct; $firstProduct < $lastProduct ; ++$firstProduct)
    { 
        if(isset($result[$firstProduct]))
        {
        $card->printCard($result[$firstProduct]);
        }
    }
?>
</section>
<form action="" method="get">
    <?php if($firstProduct > 8):?>
    <button type="submit" name="page" value="<?=(($firstProduct-8)-8) ?>"><< Page Précédente </button>
    <?php endif;
    if(isset($result[$firstProduct])):?>
    <button type="submit" name="page" value="<?=($firstProduct) ?>">Page suivante >></button>
    <?php endif;?>
</form>