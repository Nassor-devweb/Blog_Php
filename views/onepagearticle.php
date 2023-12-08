<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/dyma_php_blog/">
    <?php include_once('views/includes/head.php') ?>
</head>

<body>
    <div class="container">
        <?php require_once('views/includes/header.php') ?>
        <div class="content-onearticle">
            <div class="contenaire-article">
                <ul class="info-user">
                    <li class="info-user__photo">
                        <img src=<?= $article[0]['photo_user'] ?> alt="">
                    </li>
                    <li class="info-user__nom">
                        <?= $article[0]['nom_user'] ?>
                    </li>
                    <li class="li-vide">
                        <div></div>
                    </li>

                    <li class="info-user__nom">
                        <?php $intl = new IntlDateFormatter("fr-FR", IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
                        echo $intl->format(strtotime($article[0]['date_article']))  ?>
                    </li>
                </ul>
                <div class="article-info">
                    <h3><?= $article[0]['titre_article'] ?></h3>
                    <p class="transition">transition</p>
                    <div class="image_article_content">
                        <img src=<?= $article[0]['image_article'] ?> alt="">
                    </div>
                    <p>
                        <?= $article[0]['contenu_article'] ?>
                    </p>
                </div>
                <div>Social network</div>
                <div>info-like</div>
            </div>
            <div>
                recent Article
            </div>
            <div>
                comment
            </div>
        </div>
        <?php require_once('views/includes/footer.php') ?>
    </div>
</body>

</html>