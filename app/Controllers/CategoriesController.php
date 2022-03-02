<?php

namespace App\Controllers;

use App\Models\CategoriesModel;

class CategoriesController extends CategoriesModel
{

    /**
     * Retourne les catégories principal sous forme de radio
     */
    public function choose_primary_categories()
    {
        $result_request =$this->get_categorie(['section'=>'PRINCIPALE']);
        ?>
            <fieldset>
            <legend>Catégories princpales</legend>
            <p>A quelle catégories principale cette article est-il associés ?</p>
        <?php
        foreach($result_request as $value)
        {
            ?>
            
            <input type="radio" name="PRINCIPALE" id="<?=$value['id_categorie']?>" value="<?=$value['id_categorie']?>">
            <label for="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>
        
        <?php
    }

    public function choose_variety()
    {
        
        $result_request_variete =$this->get_categorie(['section'=>'VARIÉTÉ']);
        $result_request_specificite =$this->get_categorie(['section'=>'SPÉCIFICITÉ']);
        ?>
            <fieldset>
            <legend>Variétés & Spécificités</legend>
            <p>Choisir la variété du café et renseigner ses spécificités</p>
            <label for="VARIÉTÉ">Choisir une variété :</label>
        <?php
        foreach($result_request_variete as $value)
        {
            ?>
            
            <input type="radio" name="VARIÉTÉ" id="<?=$value['id_categorie']?>" value="<?=$value['id_categorie']?>">
            <label for="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
            <label for="SPÉCIFICITÉ">Choisir les spécificités :</label>
        <?php
        foreach($result_request_specificite as $value)
        {
            ?>
            
            <input type="checkbox" name="SPÉCIFICITÉ[]" id="<?=$value['id_categorie']?>" value="<?=$value['id_categorie']?>">
            <label for="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>
        
        <?php
    }

    public function choose_flavor()
    {
        $result_request_flavor =$this->get_categorie(['section'=>'SAVEUR']);
        ?>
            <fieldset>
            <legend>Saveur associé</legend>
            <p>Définissez les différentes saveurs de votre article</p>

            <label for="nouvelle_saveur">Ajouter une nouvelle saveur</label>
            <input type="text" name="SAVEUR" id="nouvelle_saveur">
            <input type="submit" name="ajouter_SAVEUR" value="Ajouter la saveur">
        <?php
        foreach($result_request_flavor as $value)
        {
            ?>
            
            <input type="checkbox" name="SAVEUR[]" id="<?=$value['id_categorie']?>" value="<?=$value['id_categorie']?>">
            <label for="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>
        
        <?php
    }

    public function choose_strong()
    {
        $result_request =$this->get_categorie(['section'=>'FORCE']);
        ?>
            <fieldset>
            <legend>Force</legend>
            <p>Noter la force du café</p>
        <?php
        foreach($result_request as $value)
        {
            ?>
            <input type="radio" name="FORCE" id="<?=$value['id_categorie']?>" value="<?=$value['id_categorie']?>">
            <label for="<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></label>
            <?php
        }
        ?>
        </fieldset>
        
        <?php
    }

    public function choose_provence()
    {
        $result_request = $this->get_categorie(['section' => 'PROVENENCE']);
        ?>
            <fieldset>
            <legend>Provenence</legend>
            <p>Définir la région originaire du café</p>

            <label for="liste_provenence">Liste des provenences :</label>
            <input list="all_provenence" name="PROVENENCE" id="liste_provenence">
            <datalist id="all_provenence">
            
        <?php
        foreach($result_request as $value)
        {
            ?>
                <option value = "<?=$value['id_categorie']?>"><?=$value['nom_categorie']?></option>
            <?php
        }
        ?>
        </datalist>

        <label for="nouvelle_PROVENENCE">Ajouter une nouvelle provenence</label>
        <input type="text" name="PROVENENCE" id="nouvelle_PROVENENCE">
        <input type="submit" name="ajouter_PROVENENCE" value="Ajouter la provenece">

        </fieldset>
        
        <?php
    }

    public function when_insert_categorie(string $name_submit)
    {
        if(!empty($_POST[$name_submit])){
            $section = explode('_',$name_submit)[1];
            if(!empty($_POST['nom_'.$section]))
            {
            $value = $_POST['nom_'.$section];
            $this->insert_categorie($section,$value);
            }
        }
    }

    public function print_all_cat($array)
    {
        foreach($array as $key => $value)
        {
                if($key == 'FORCE'|| $key == 'fORCE')
                {
                    $i = 1;
                    $result = '';
                    while($i <= $this->get_name_by_id($value))
                    {
                        $result .='&#x272D ';
                        $i++;
                    }
                    ?>
                    <p><?php echo "{$key}"?> : <?=$result?></p>
                    <?php
                }
                elseif(($key=='SAVEUR')||($key=='SPÉCIFICITÉ'))
                {   
                    $list_argument = '';
                    for($i = 0; $i < count($value); ++$i)
                    {
                        $list_argument .= " {$this->get_name_by_id($value[$i])},";
                    }
                    $list_argument[-1] = ' ';
                    ?>
                    <p><?php echo "{$key}"?> : <?=$list_argument?></p>
                    <?php
                }
                elseif($key=='etape2'||$key=='PROVENENCE')
                {
                    
                }
                else
                {
                ?>
                <p><?php echo "{$key}";?>:<?=$this->get_name_by_id($value)?></p>
                <?php
                }
            
        }
    }
}
?>