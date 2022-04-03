    <ul>
        <li><a href="./creerArticle/partie1">Creer un Article ></a></li>
        <li><a href="./modifierArticle/liste">Modifier un articles ></a></li>
        <li><a href="./gestiondestock">Gestion des stocks ></a></li>
        <li><a href="./validercommande></a>Gestion des livraisons </li>
        <li><a href=" ./commentaire">Gestion des commentaires ></a></li>
        <li><a href="./gestionUtilisateur/liste">Gestion des utilisateurs ></a></li>
        <li><a href="profil/deconnexion">Se deconnecter</a></li>
    </ul>


    <h1>category CRUD</h1>

    <?php if (isset($_SESSION['flash'])) : ?>
        <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
            <div><?= $message; ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])) :  ?>
        <?php unset($_SESSION['flash']) ?>
    <?php endif; ?>
    <form method="post" name="crudCreate">
        <label> Créer categorie</label>
        <input name="nom_categorie" placeholder="Nouvelle categorie" type="text">
        <input name="section" placeholder="Nouvelle section" type="text">
        <button name="create_cat" type="submit"> Créer categorie </button>

    </form>

    <?php foreach ($category as $value) { ?>


        <label> Categorie : </label>

        <form action="" method="post">

            <input name="id_categorie" value="<?= $value['id_categorie'] ?>" type="hidden">
            <input name="nom_categorie" value="<?= $value['nom_categorie'] ?>" type="text">
            <input name="section" value="<?= $value['section'] ?>" type="text">
            <button name="update_cat" type="submit"> Modifier categorie </button>
            <button name="delete_cat" type="submit"> Suppr categorie </button>
        </form>




    <?php } ?>