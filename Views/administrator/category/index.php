             <article class="mainAndSideAdmin">
                 <section class="sideBarreAcount">
                     <div>
                         <h1>Admin</h1>
                         <ul>
                             <li><a href="./creerArticle/partie1">Creer un Article</a><i class="fa-solid fa-angle-right"></i></li>
                             <li><a href="./modifierArticle/liste">Modifier un articles</a><i class="fa-solid fa-angle-right"></i></li>
                             <li><a href="./gestiondestock">Gestion des stocks</a><i class="fa-solid fa-angle-right"></i></li>
                             <li><a href="./validercommande"> Gestion de commande</a><i class="fa-solid fa-angle-right"></i></li>
                             <li><a href="./categorie">Gestion des categories</a><i class="fa-solid fa-angle-right"></i></li>
                             <li><a href="./tag">Gestion des tags</a><i class="fa-solid fa-angle-right"></i></li>
                             <li><a href="./commentaire">Gestion des commentaires</a><i class="fa-solid fa-angle-right"></i></li>
                             <li><a href="./gestionUtilisateur/liste">Gestion des utilisateurs</a><i class="fa-solid fa-angle-right"></i></li>
                             <li><a href="../profil/deconnexion">Se deconnecter</a></li>
                         </ul>
                     </div>
                 </section>
                 <div class="containerMain">

                     <div class="containerMain">

                         <div class="layoutContainertable">


                             <div>
                                 <article>
                                     <h1>Admin category :</h1>

                                     <?php if (isset($_SESSION['flash'])) : ?>
                                         <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                                             <div><?= $message; ?></div>
                                         <?php endforeach; ?>
                                     <?php endif; ?>

                                     <?php if (isset($_SESSION['flash'])) :  ?>
                                         <?php unset($_SESSION['flash']) ?>
                                     <?php endif; ?>
                                     <form method="post" name="crudCreate">
                                         <label> Créer </label>
                                         <input name="nom_categorie" placeholder="Nouvelle categorie" type="text">
                                         <input name="section" placeholder="Nouvelle section" type="text">
                                         <button class="form__button" name="create_cat" type="submit"> Créer </button>

                                     </form>

                                     <?php foreach ($category as $value) { ?>

                                         <label> Categorie : </label>

                                         <form action="" method="post">

                                             <input name="id_categorie" value="<?= $value['id_categorie'] ?>" type="hidden">
                                             <input name="nom_categorie" value="<?= $value['nom_categorie'] ?>" type="text">
                                             <input name="section" value="<?= $value['section'] ?>" type="text">
                                             <button class="form__button" name="update_cat" type="submit"> Modifier</button>
                                             <button class="form__button--delete" name="delete_cat" type="submit"> X </button>
                                         </form>

                                     <?php } ?>
                                 </article>
                             </div>

                         </div>
                     </div>

             </article>