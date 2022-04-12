<?php if (isset($_SESSION['flash'])) : ?>
                    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                        <div><?= $message; ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['flash'])) :  ?>
                    <?php unset($_SESSION['flash']) ?>
                <?php endif; ?>
<article class="mainAndSideAdmin">
    <section class="sideBarreAcount">
        <div>
            <h1>Admin</h1>
            <ul>
                <li><a href="../creerArticle/partie1">Creer un Article</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../modifierArticle/liste">Modifier un articles</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../gestiondestock">Gestion des stocks</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../validercommande"> Gestion de commande</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../categorie">Gestion des categories</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../tag">Gestion des tags</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../commentaire">Gestion des commentaires</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="">Gestion des utilisateurs</a><i class="fa-solid fa-angle-right"></i></li>
                <li><a href="../profil/deconnexion">Se deconnecter</a></li>
            </ul>
        </div>
    </section>

    <article class="mainUpdateProduct mainUpdateProduct--low">
    <?php if ($param == "liste") : ?>
        <article class="tableEmergencyRestock">
            <h1>Gestion des utilisateurs</h1>
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th class="hidde">Prenom</th>
                        <th class="hidde">Nom</th>
                        <th>Role</th>
                        <th>test</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user['email'] ?></td>
                            <td class="hidde"><?= $user['prenom'] ?></td>
                            <td class="hidde"><?= $user['nom'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td> <button><a class="test" href="./<?= $user['id_utilisateur'] ?>">Modifier</a></button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </article>
    <?php endif; ?>

    <?php if ($param !== "liste") : ?>
        <article class="user-data">
            
        <h2 class="title__profil">Données de l'utilisateurs</h2>
        <form action="" method="post">
            <!-- <?php var_dump($userInfos[0])?> -->
            <?php foreach ($userInfos[0] as $key => $userInfo) : ?>
                <?php if ($key == 'role') : ?>
                    <label for="role">Choisissez votre role</label>
                    <select name="<?= $key ?>" id="role">
                        <option>Utilisateurs</option>
                        <option>Admin</option>
                    </select>
                <?php elseif ($key == 'id_utilisateur') : ?>
                    <input type="hidden">
                <?php elseif ($key == 'password') : ?>  
                    <label for="">Password :</label>
                    <input type="text" name="<?= $key ?>">
                <?php else : ?>
                    <label for=""><?= ucfirst($key) ?> : </label>
                    <input type="text" value="<?= $userInfo ?>" name="<?= $key ?>">
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="user-cta">
            <input class="form__button form__button--user" type="submit" name="modifier" value="Modifier">
            <input class="form__button form__button--user" type="submit" name="supprimer" value="Supprimer">
            </div>
        </form>
        </article>
    <?php endif; ?>
    </article>

</article>