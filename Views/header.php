<?php require 'app/Controllers/headerController.php'?> 
<nav>
    <ul>
        <li><a href="/boutique-en-ligne/"><img style="height:40px"src="/boutique-en-ligne/public/assets/pictures/kawa_logo_color.svg" alt="revenir à l'accuil principal"></a></li>
        <li>
            <form action="/boutique-en-ligne/boutique/all" method="GET">
                <label for="site-search">Search the site:</label>
                <input type="search" name="recherche" aria-label="Search through site content">
                <button><i class="fas fa-search"></i></button>
            </form>
        </li>
        <li><a href=""><i class="fa-solid fa-cart-shopping"></i></a></li>
        <li><a href="<?=$userPath?>"><?=$iconUser?></a></li>
    </ul>
</nav>