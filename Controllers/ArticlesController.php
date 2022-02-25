<?php

namespace App\Controllers;

use App\Models\ArticlesModel;

class ArticlesController extends ArticlesModel
{
    public $image_article;
    public $error= [];

    /**
    * Verifie la taille du fichier télécharger
    * Verifie si le téléchargement a bien était effectuée
    * @param string nom du fichier à verifier
    * @param int taille du fichier maximum
    * @return bool Si le fichier et inferieur à la taille maximal alors True, sinon False
    */
   public function verify_upload(string $name_file, ?int $size = 1000000):bool
   {
       if(@$_FILES[$name_file]['size']>$size)
       {
           $this->error['image'] = 'Le fichier télécharger est trop volumineux, taille maximum 1Mo';
           return false;
       }
       elseif(empty($_FILES[$name_file]['tmp_name'])){
           $this->error['image'] = 'Le téléchargement de l\'image n\'a pas été effectué';
           return false;
       }
       else return true;
   }

    /**
     * Traite l'image et l'ajoute dans un dossier donnée
     * Modifie le nom de l'image
     * @param string chemin d'enregistrement
     */
    public function stock_picture(?string $chemin = '../../assets/images/')
    {
        if($this->verify_upload('image_article')==true)
        {
        //Verification de l'extention du fichier reçu
        $explode_file = explode(".",$_FILES['image_article']['name']);
        $extention = ['jpeg','jpg','JPEG','JPG'];

            foreach($extention as $value)
            {
                if($value == $explode_file[1]){
                    $approuve = true;
                }
            }

            if($approuve==true)
            {
            //si approuver, traitement du fichier
                $explode_file[0] = uniqid(); //Renomage du fichier avec une string unique
                $explode_file[1] = ".$explode_file[1]";//Ajout du dote avant concatenation
                $_FILES['image_article']['name'] = $explode_file[0].$explode_file[1];//Concataination du nom et de l'exention
                $im_miniature = $_FILES['image_article']['name'];
                
                //Modification de la taille de l'image
                $taille = getimagesize($_FILES['image_article']['tmp_name']);//Traitement de la largeur et  de la hauteur d'origine du fichier
                $largeur = $taille[0];
                $hauteur = $taille[1];
                $largeur_miniature = 720; //Definition de la nouvelle largeur
                $hauteur_miniature = $hauteur / $largeur * 720; //Definition de la nouvelle hauteur relative à la largeur
                $im = imagecreatefromjpeg($_FILES['image_article']['tmp_name']);//Creation d'une nouvelle image dans la memoire tampon
                $im_miniature = imagecreatetruecolor($largeur_miniature, $hauteur_miniature);//creation d'un gabari selon les dimention defini
                imagecopyresampled($im_miniature, $im, 0, 0, 0, 0, $largeur_miniature, $hauteur_miniature, $largeur, $hauteur);//redimention de l'image à la taille de l'image tampon
                imagejpeg($im_miniature, $chemin.$_FILES['image_article']['name'],90);//Création de l'image dans le dossier assigner

                $this->image_article = $_FILES['image_article']['name'];

                return $this->image_article;
            }
            else $this->error['image'] = 'Assurez-vous que l\'image soit bien en jpg,jpeg.';

            return null;
        }
    }

    /**
     * Affiche une vignette avec le résultat du téléchargement
     * @param string lein vers l'image
     * @param string Nome de l'image selectionner
     */
    public function screen_result(?string $chemin = '../../assets/images/',?string $nom_image = 'no_img_produit.jpg')
    {
        ?>
            <img style="width: 200px;height: 200px;" src="<?=$chemin.$nom_image?>" alt="votre nouvelle image d'article'">
        <?php
    
      
    }

    public function select_col_table($table)
    {     
        $result = $this->return_col($table);
        $column = [];
        foreach($result as $key)
        {
            $keyCol = $key['Field'];
            $column[] = $keyCol;
        }
        return $column;
    }
}