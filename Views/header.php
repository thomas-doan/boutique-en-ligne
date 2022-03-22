<?php require 'app/Controllers/headerController.php'?> 
    <nav class="nav">

        <section class="nav__list">
            <a class="nav__link" href="/boutique-en-ligne/">
                <img class="nav__logo" style="height:40px"src="/boutique-en-ligne/public/assets/pictures/kawa_logo_color.svg" alt="revenir à l'accuil principal">
            </a>

            <a class="nav__link" href="">
                <i class="nav__icon fa-solid fa-cart-shopping"></i>
            </a>

            <a class="nav__link" href="<?=$userPath?>"><?=$iconUser?></a>
        </section>
        
        <form class="nav__search" action="/boutique-en-ligne/boutique/all" method="GET">
            <label for="site-search">Search the site:</label>

                <input type="search" name="recherche" aria-label="Search through site content">
                <button class="nav__link">
                    <i class="nav__icon fas fa-search"></i>
                </button>
        </form>


        

    </nav>