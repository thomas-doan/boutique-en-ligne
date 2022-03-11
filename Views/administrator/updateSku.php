<h3>Gestion de Stock</h3>
<section>
    <h3>Admin</h3>
    <ul>
        <li><a href="creerArticle/partie1">Creer un Article ></a></li>
        <li><a href="modifierArticle/liste">Modifier un articles ></a></li>
        <li><a href="../gestiondestock">Gestion des stocks ></a></li>
        <li><a href="">Historique de commande ></a></li>
        <li><a href="">Gestion de livraison ></a></li>
        <li><a href="gestionUtilisateur/liste">Gestion des utilisateurs</a></li>
        <li><a href="../profil/deconnexion">Se deconnecter</a></li>
    </ul>
</section>
<article>
    <h4>Produit au stock limités</h4>
    <table>
    <thead>
        <tr>Nom de l'Article</tr>
        <tr>Catégorie Principale</tr>
        <tr>Nombre unitaire en stock</tr>
        <tr>selectionner</tr>
    </thead>
    <tbody>
        <?php foreach($urgentStock as $value) :?>
        <tr id="<?=$value['id_article']?>">
            <td><?=$value['titre_article']?></td>
            <td><?=$value['cat parent']?></td>
            <td><?=$value['sku']?></td>
            <td>
                <form action="#<?=$value['id_article']?>" method="POST">
                    <?php if(empty($_POST['enterFormNow'.$value['id_article']])):?>
                        <button type="submit" name="enterFormNow<?=$value['id_article']?>">Restocker</button>
                    <?php else :?>
                        <input type="text" name="sku" value="<?=$value['sku']?>">
                        <button type="submit" name="id_article" value="<?=$value['id_article']?>">Ajouter au Stock</button>
                    <?php endif;?>
                </form>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</article>
<form action="" method="GET">
    <fieldset>
        <legend>Recherche avancée</legend>
        <label for="site-search">Rechercher par nom</label>
        <input type="search" name="recherche" aria-label="Search through site content">
        <button>Search</button>
    </fieldset>
</form>
<form action="<?=$urlRedirect?>" method="POST">
<label for="PRINCIPALE ">Trier par Catégories Principales</label>
        <select list="list_categories" name="PRINCIPALE" id="list_categories">
            <datalist id="list_categories">
                <option></option>
                <?php foreach($allCategories as $value):?>
                    <option value = "<?=$value['nom_categorie']?>"><?=$value['nom_categorie']?>(<?=$methodImport->countSearch($value['nom_categorie'])?>)</option>
                <?php endforeach;?>
            </datalist>
        </select>
        <input type="submit" value='appliquer'>
</form>

<table>
    <h4>Tout les articles</h4>
    <thead>
        <tr>Nom de l'Article</tr>
        <tr>Catégorie Principale</tr>
        <tr>Nombre unitaire en stock</tr>
        <tr>selectionner</tr>
    </thead>
    <tbody>
        <?php foreach($resultSearch as $value) :?>
        <tr id="<?=$value['id_article']?>">
            <td><?=$value['titre_article']?></td>
            <td><?=$value['cat parent']?></td>
            <td><?=$value['sku']?></td>
            <td>
                <form action="#<?=$value['id_article']?>" method="POST">
                    <?php if(empty($_POST['enterForm'.$value['id_article']])):?>
                        <button type="submit" name="enterForm<?=$value['id_article']?>" value="<?=$value['id_article']?>">Restocker</button>
                    <?php else :?>
                        <input type="text" name="sku">
                        <button type="submit" name="id_article" value="<?=$value['id_article']?>">Ajouter au Stock</button>
                    <?php endif;?>
                </form>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>