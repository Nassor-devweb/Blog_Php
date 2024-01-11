<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/blog_miashs/">
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
                    <div class="image_article_content">
                        <img src=<?= $article[0]['image_article'] ?> alt="">
                    </div>
                    <p>
                        <?= $article[0]['contenu_article'] ?>
                    </p>
                </div>
            </div>
            <div class="contentFormComent" id="formContent">
                <form action=<?= "comentController/save_coment/{$article[0]['id_article']}/{$_SESSION['id_user']}" ?> method="POST">
                    <textarea name="contenu_coment" id="contenu_coment">Écrivez un commentaire</textarea>
                    <p class="error"><?= (isset($error)) ? $error : "" ?></p>
                    <button type="submit" class="btn save btn-coment">Publier mon avis</button>
                </form>
            </div>
            <div class="contentFormComent">
                <?php foreach ($allComent as $coment) : ?>
                    <div class="contentComment">
                        <ul class="info-user">
                            <li class="info-user__photo">
                                <img src=<?= $coment['photo_user'] ?> id='img-user' alt="">
                            </li>
                            <li class="info-user__nom">
                                <?= $coment['nom_user'] ?>
                            </li>
                            <li class="li-vide">
                                <div></div>
                            </li>

                            <li class="info-user__nom">
                                <?php $intl = new IntlDateFormatter("fr-FR", IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
                                echo $intl->format(strtotime($coment['date_coment']))  ?>
                            </li>
                        </ul>
                        <p class="message-content">
                            <?= $coment['contenu_coment'] ?>
                        </p>
                    </div>
                <?php endforeach;  ?>
            </div>
        </div>
        <?php require_once('views/includes/footer.php') ?>
    </div>
</body>

</html>