<p> c'est l'accueil</p>

<?php foreach ($articles as $value) { ?>

    <a href="./exempleid/<?= $value['id_article'] ?>"> lien."<?= $value['id_article'] ?>"
    </a>

<?php } ?>

<?php
echo "<br>";
echo "<br>";
echo "<br>";
echo "<pre>";
var_dump($jojo);
echo "</pre>";
?>