<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <?php require_once 'header.php'; ?>
    </header>
    <main>
        <?= $pageContent ?>
    </main>
    <footer>
        <?php require_once 'footer.php'; ?>
    </footer>
</body>

</html>