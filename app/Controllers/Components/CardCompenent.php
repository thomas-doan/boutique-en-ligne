<?php

namespace App\Controllers\Components;

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
                <?php if($dataProduct['sku']!==0):?>
                <button><a href="/boutique-en-ligne/produit/<?=$dataProduct['id_article']?>">Consulter</a></button>
                <?php endif;?>
            </div>
        </section>
    <?php
    }
}