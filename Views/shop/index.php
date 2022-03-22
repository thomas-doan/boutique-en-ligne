<?php ?>
<p> c'est l'accueil</p>
<section class="hero">
<img style="width:100%;" src=".\public\assets\pictures\kawa_img_hero_mobile.jpg" alt="hero">
<div class="CTA">
    <h2>Kawa</h2>
    <h3>Une boutique dédier aux amateurs de café</h3>
    <button><a href="./boutique/all">Découvrir ></a></button>
</div>
</section>
<section class="bestArticle">
    <?php for($i = 0; $i <=$selectNumberofCard;$i++):?>
    <?php $cards->printCard($cards->getDataByid($bestArticle[$i]['fk_id_article']))?>
    <?php endfor; ?>
</section>
<section class="lastProduct">
    <img style="width : 80px;"src=".\public\assets\pictures\kawa_icon_new.svg" alt="">
    <?php $cards->printCard($cards->getDataByid($lastidProduct))?>
</section>
<article>
    <h2>Comment aimez vous boire votre café ?</h2>
    <a href="./boutique/all?selection=1"><section><img src="" alt="">
        <section>
            <img src="public\assets\pictures\kawa_img_card1.jpg" alt="">
            <p>Un deca sans pression</p>
        </section>
    </a>
    <a href="./boutique/all?selection=2"><section><img src="" alt="">
        <section>
            <img src="public\assets\pictures\kawa_img_card2.jpg" alt="">
            <p>Noir et bien corsée</p>
        </section>
    </a>
    <a href="./boutique/Moulu"><section><img src="" alt="">
        <section>
            <img src="public\assets\pictures\kawa_img_card3.jpg" alt="">
            <p>Moulu à souhait</p>
        </section>
    </a>
    <a href="./boutique/Dosette"><section><img src="" alt="">
        <section>
            <img src="public\assets\pictures\kawa_img_card4.jpg" alt="">
            <p>La Dosette douceur du matin</p>
        </section>
    </a>
    <a href="./boutique/all?recherche=Afrique"><section><img src="" alt="">
        <section>
            <img src="public\assets\pictures\kawa_img_card5.jpg" alt="">
            <p>J'aime découvrir des nouvelles saveurs</p>
        </section>
    </a>
    <a href="./boutique/all?recherche=Biologique"><section><img src="" alt="">
        <section>
            <img src="public\assets\pictures\kawa_img_card6.jpg" alt="">
            <p>Un café en accord avec la nature</p>
        </section>
    </a>
    <a href="./boutique/Grain"><section><img src="" alt="">
        <section>
            <img src="public\assets\pictures\kawa_img_card7.jpg" alt="">
            <p>Au percolateur</p>
        </section>
    </a>
    <a href="./boutique/all?recherche=Equilibré"><section><img src="" alt="">
        <section>
            <img src="public\assets\pictures\kawa_img_card8.png" alt="">
            <p>Un café légé et équilibré</p>
        </section>
    </a>
</article>
<article>
    <h3>A propos</h3>
    <p>Cette boutique en ligne est l'oeuvre de trois étudiant s'exerçant dans un cursus dans le domaine du Developpement Web & Mobile. Elle n'a pas pour vocation de vous permettre de commander du Café.</p>
</article>