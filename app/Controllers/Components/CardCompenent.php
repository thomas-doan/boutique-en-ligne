<?php

namespace App\Controllers\Components;

use App\Controllers\ProductController;
use Database\DBConnection;
use App\Models\Product;


class CardCompenent extends Product
{

    public function printCard(array $dataProduct)
    {

    ?>
        <section class="card">
            <img class="picture" src="/boutique-en-ligne/public/assets/pictures/pictures_product/<?=$dataProduct['image_article']?>" alt="">
            <?php if(isset($dataProduct['SPÉCIFICITÉ']) && in_array('Biologique',$dataProduct['SPÉCIFICITÉ'])==true):?>
                <img class="logoAb" src="/boutique-en-ligne/public/assets/pictures/pictures_product/kawa_logo_ab.png" alt="">
            <?php endif;?>
            <?php if($dataProduct['sku']==0):?>
                <img class="logonostock" src="/boutique-en-ligne/public/assets/pictures/pictures_product/kawa_vigne_nostock.png" alt="">
            <?php endif;?>
            <div>
            <h3><?=$dataProduct['titre_article']?></h3>
            <p><?=$dataProduct['presentation_article']?></p>
            </div>
            <div class="inOver">
                <div>
                <H4>like</H4>
                <h4><?=$dataProduct['prix_article']?>€</h4>
                </div>
                <p><?=$dataProduct['description_article']?></p>
                
                <button><a href="/boutique-en-ligne/produit/<?=$dataProduct['id_article']?>">Consulter</a></button>
                <?php if($dataProduct['sku']!==0):?>
                    <?php $FooBag = new ProductController;?>
                    <form action="" method="post">
                    <label for="addBasket"></label>
                    <input type="hidden" name="id_article" value="<?=$dataProduct['id_article']?>"></input>
                    <input type="hidden" name="prix_article" value="<?=$dataProduct['prix_article']?>"></input>
                    <input type="submit" id="addBasket" name="add" value="AJOUTER AU PANIER >">
                    </form>
                <?php endif;?>
            </div>
        </section>
    <?php
    }
}