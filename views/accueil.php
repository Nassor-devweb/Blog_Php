<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/dyma_php_blog/">
    <?php include_once('views/includes/head.php') ?>
</head>

<body>
    <div class="container">
        <?php require_once('views/includes/header.php') ?>
        <div class="content-accueil">
            <?php foreach ($allArticle as $article) : ?>
                <div class="article-contenaire" id=<?= 'id-article' . $article['id_article'] ?>>
                    <div class="img-contenaire">
                        <img src=<?= $article['image_article'] ?> alt="">
                    </div>
                    <div class="info-article">
                        <div class="info-user">
                            <img src=<?= $article["photo_user"] ?> alt="" class="photo_user">
                            <div class="info-user__date">
                                <?php
                                $formateur = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::MEDIUM);
                                ?>
                                <span class="nom_user"><?= $article["nom_user"] ?></span>

                                <span><?= "Le " . $formateur->format(strtotime($article['date_article'])) ?></span>
                            </div>
                        </div>
                        <div class="title-article">
                            <a href=<?= "articleControllers/getOneArticle/{$article['id_article']}" ?> class="title-link" href=<?= "#id-article" . $article['id_article'] ?>>
                                <h3><?= $article["titre_article"] ?></h3>
                            </a>
                            <a href=<?= "articleControllers/getOneArticle/{$article['id_article']}" ?> class="content-link">
                                <p><?= $article['contenu_article'] ?></p>
                            </a>
                        </div>
                        <div class="contenaire-comment-btn">
                            <div class="like_message-contenaire">
                                <div class="message-content">
                                    <i class="fa-regular fa-message"></i>
                                    <span class="nb_coment"><?= $article["nb_coment"] ?></span>
                                </div>
                                <div class="like-content">
                                    <?= ($article["is_like"]) ? "<a href='articleControllers/dislikeArticle/{$article['id_article']}#id-article{$article['id_article']}' ><i class='fa-solid fa-heart' id='heart-red'></i></a>" :
                                        "<a href='articleControllers/likeArticle/{$article['id_article']}#id-article{$article['id_article']}' ><i class='fa-regular fa-heart' id='heart-black'></i></a>" ?>
                                    <span class="nb_like"><?= $article["nb_like"] ?></span>
                                </div>

                            </div>
                            <div class="btn-content">
                                <?= ($article["id_user"] == 1) ? "<button class='btn save btn-small12'>Modifier</button>
                                <button class='btn btn-danger btn-small12 btn-accueil'>Supprimer</button>" : "" ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php require_once('views/includes/footer.php') ?>
    </div>
</body>

</html>