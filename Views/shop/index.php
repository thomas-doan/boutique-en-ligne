<section class="hero">
    <img style="width:100%;" src=".\public\assets\pictures\kawa_img_hero_desktop.jpeg" alt="hero">
    <div class="CTA">
        <h1>Kawa</h1>
        <h2>Une boutique dédier aux amateurs de café</h2>
        <button><a href="./boutique/all">Découvrir ></a></button>
    </div>
</section>
<article class="homeProposition">
    <section class="caroussel caroussel--home">
        <div class="caroussel__element">
            <?php for ($i = 0; $i <= $selectNumberofCard; $i++) : ?>
                <?php $cards->printCard($cards->getDataByid($bestArticle[$i]['fk_id_article'])) ?>
            <?php endfor; ?>
        </div>
    </section>

    <section class="lastProduct">
        <?php $cards->printCard($cards->getDataByid($lastidProduct)) ?>
        <img style="width : 80px;" src=".\public\assets\pictures\kawa_icon_new.svg" alt="">
    </section>
</article>
<h2>Comment aimez vous boire votre café ?</h2>
<article class="containerCard">


    <section class="cardChoice">
        <a href="./boutique/all?selection=1">
            <img src="public\assets\pictures\kawa_img_card1.jpg" alt="">
            <p>Un deca sans pression</p>
        </a>
    </section>


    <section class="cardChoice">
        <a href="./boutique/all?selection=2">
            <img src="public\assets\pictures\kawa_img_card2.jpg" alt="">
            <p>Noir et bien corsée</p>
        </a>
    </section>

    <section class="cardChoice">
        <a href="./boutique/Moulu">
            <img src="public\assets\pictures\kawa_img_card3.jpg" alt="">
            <p>Moulu à souhait</p>
        </a>
    </section>

    <section class="cardChoice">
        <a href="./boutique/Dosette">
            <img src="public\assets\pictures\kawa_img_card4.jpg" alt="">
            <p>La Dosette douceur du matin</p>
        </a>
    </section>

    <section class="cardChoice">
        <a href="./boutique/all?recherche=Afrique">
            <img src="public\assets\pictures\kawa_img_card5.jpg" alt="">
            <p>J'aime découvrir des nouvelles saveurs</p>
        </a>
    </section>

    <section class="cardChoice">
        <a href="./boutique/all?recherche=Biologique">
            <img src="public\assets\pictures\kawa_img_card6.jpg" alt="">
            <p>Un café en accord avec la nature</p>
        </a>
    </section>

    <section class="cardChoice">
        <a href="./boutique/Grain">
            <img src="public\assets\pictures\kawa_img_card7.jpg" alt="">
            <p>Au percolateur</p>
        </a>
    </section>

    <section class="cardChoice">
        <a href="./boutique/all?recherche=Equilibré">
            <img src="public\assets\pictures\kawa_img_card8.png" alt="">
            <p>Un café légé et équilibré</p>
        </a>
    </section>

</article>

<article class="aboutUs">
    <h3>A propos</h3>
    <img src="./public/assets/pictures/kawa_logo_blac_text.svg" alt="">
    <p>Cette boutique en ligne est l'oeuvre de trois étudiant s'exerçant dans un cursus dans le domaine du Developpement Web & Mobile. Elle n'a pas pour vocation de vous permettre de commander du Café. Par conséquent les articles plésentés peuvent être imaginaires</p>
</article>