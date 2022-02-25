<?php  var_dump($_GET);
echo $_SERVER['REQUEST_URI'];
$str = 'blablablapourquoiblabla';
$array = explode('pourquoi',$str);
var_dump($array);
?>
<h1>Voici toutes nos annonces</h1>

<form action="" method="get">
<input type="text" name="recherche"?>
<input type="submit" value="rechercher">
</form>