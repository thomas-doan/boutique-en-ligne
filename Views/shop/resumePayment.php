<article>


    <?php

    /* if(isset($_SESSION['quantityPayment'])) { ?>
<h2>Votre commande est  enregistrée.</h2>
<?php foreach($_SESSION['quantityPayment'][$id_article] ) {} ?>
<p> </p>



<?php } ?> */



    echo "<pre>";
    var_dump($_SESSION['num_commande']);
    echo "<br>";
    var_dump($_SESSION['quantityPayment']);
    echo "</pre>";

    ?>

</article>