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
                <form action="articleControllers/save_article_control" method="POST" enctype="multipart/form-data">
                    <div class="form-group form">
                        <label for="title">Titre :</label>
                        <input type="text" name="title" id="title">
                        <span class="error"></span>
                    </div>
                    <div class="form-group form">
                        <label for="category">categorie : </label>
                        <select name="category" id="category">
                            <option value="technology">Techologie</option>
                            <option value="reading">Littérature</option>
                            <option value="astronomy">Astronomie</option>
                            <option value="web">Web</option>
                        </select>
                    </div>
                    <div class="form-group form">
                        <label for="content">Contenu:</label>
                        <textarea name="content" id="content" placeholder="Saisir votre article"></textarea>
                        <span class="error"></span>
                    </div>
                    <div class="form-group form" id="group">
                        <label for="file">Inserer une image :</label>
                        <input type="file" name="file" id="file">
                        <span class="error"></span>
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