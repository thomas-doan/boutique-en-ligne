<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/boutique-en-ligne/public/css/style.css">
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php require_once 'header.php'; ?>
    </header>
    <main>
        <?php require_once 'panier.php';?>
        <?= $pageContent ?>
    </main>
    <footer>
        <?php require_once 'footer.php'; ?>
    </footer>
</body>

</html>