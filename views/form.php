<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="/dyma_php_blog/">
    <?php include_once('views/includes/head.php') ?>
</head>

<body>
    <div class="container">
        <?php require_once('views/includes/header.php') ?>
        <div class="content">
            <div class="block">
                <h1>Ecrire votre article</h1>
                <form <?= (isset($udapteArticle)) ? "action='articleControllers/updateArticle/$idArticle'" : "action = 'articleControllers/save_article_control'" ?> method="POST" enctype="multipart/form-data">
                    <div class="form-group form">
                        <label for="title">Titre :</label>
                        <input type="text" name="title" id="title" <?= isset($dataArticle[0]['titre_article']) ? "value='" . $dataArticle[0]['titre_article'] . "'" : "value=''" ?>>
                        <span class="error"></span>
                    </div>
                    <div class="form-group form">
                        <label for="category">categorie : </label>
                        <select name="category" id="category">
                            <option value="technology" <?= (isset($dataArticle[0]['categorie_article']) && $dataArticle[0]['categorie_article'] == "technology") ? "selected" : "" ?>>Techologie</option>
                            <option value="animaux" <?= (isset($dataArticle[0]['categorie_article']) && $dataArticle[0]['categorie_article'] == "animaux") ? "selected" : "" ?>>Animaux</option>
                            <option value="astronomy" <?= (isset($dataArticle[0]['categorie_article']) && $dataArticle[0]['categorie_article'] == "astronomy") ? "selected" : "" ?>>Astronomie</option>
                            <option value="web" <?= (isset($dataArticle[0]['categorie_article']) && $dataArticle[0]['categorie_article'] == "web") ? "selected" : "" ?>>Web</option>
                            <option value="vehicule" <?= (isset($dataArticle[0]['categorie_article']) && $dataArticle[0]['categorie_article'] == "vehicule") ? "selected" : "" ?>>Véhicule</option>
                        </select>
                    </div>
                    <div class="form-group form">
                        <label for="content">Contenu:</label>
                        <textarea name="content" id="content"><?= isset($dataArticle[0]['contenu_article']) ? $dataArticle[0]['contenu_article'] : "" ?></textarea>
                        <span class="error"></span>
                    </div>
                    <div class="form-group form" id="group">
                        <label for="file">Inserer une image :</label>
                        <input type="file" name="file" id="file">
                        <span class="error"><?= (isset($error) && $error) ? $error : "" ?></span>
                    </div>
                    <div class="button-content">
                        <a href="" class="btn btn-danger btn-small">Annuler</a>
                        <button class="btn save btn-small" type="submit">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
        <?php require_once('views/includes/footer.php') ?>
    </div>
</body>

</html>