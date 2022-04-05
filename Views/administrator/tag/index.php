   <div class="containerMain">

       <article id="menu">
           <section>
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
                   <li><a href="profil/deconnexion">Se deconnecter</a></li>
               </ul>
           </section>

       </article>
       <div id="header">
           <div id="menu-burger">
               <div class="bar1"></div>
               <div class="bar2"></div>
               <div class="bar3"></div>
           </div>
       </div>


       <div class="layoutContainertable">

           <div>
               <article>
                   <h1>Admin tag : </h1>

                   <?php if (isset($_SESSION['flash'])) : ?>
                       <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                           <div><?= $message; ?></div>
                       <?php endforeach; ?>
                   <?php endif; ?>

                   <?php if (isset($_SESSION['flash'])) :  ?>
                       <?php unset($_SESSION['flash']) ?>
                   <?php endif; ?>
                   <form method="post" name="crudTag">
                       <label> Créer un tag</label>
                       <input name="nom_tag" placeholder="insérer texte" type="text">
                       <button class="form__button" name="create_tag" type="submit"> Créer tag </button>

                   </form>

                   <?php foreach ($tag as $value) { ?>

                       <form action="" method="post">

                           <input name="id_tag" value="<?= $value['id_tag'] ?>" type="hidden">

                           <input name="nom_tag" class="form__label" value="<?= $value['nom_tag'] ?>" type="text">

                           <button class="form__button" name="update_tag" type="submit"> Modifier </button>
                           <button class="form__button" name="delete_tag" type="submit"> X </button>
                       </form>

                   <?php } ?>

               </article>
           </div>

       </div>
   </div>