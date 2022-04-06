<article class="form">

    <section class="alert">
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div><?= $message; ?></div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['flash'])) :  ?>
            <?php unset($_SESSION['flash']) ?>
        <?php endif; ?>
    </section>


    <form action="#" method="post" class="form__container">
        <h1 class="form__title">Votre email </h1>

        <div class="form__field">
            <label class="form__label" for="email">Email : </label>
            <input class="form__text" type="text" id="email" name="emailVerify">
        </div>
        <div class="form__field">
            <input class="form__button" type="submit" name="submit" value="verification email">
        </div>

    </form>

</article>