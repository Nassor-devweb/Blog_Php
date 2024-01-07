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
                <h1>Inscrivez-vous</h1>
                <form action="userController/inscription" method="POST" enctype="multipart/form-data">
                    <div class="form-group form">
                        <label for="nom_user">Pseudo :</label>
                        <input type="text" name="nom_user" id="nom_user" <?= isset($dataUser['nom_user']) ? "value=" . $dataUser['nom_user'] : "" ?>>
                    </div>
                    <div class="form-group form">
                        <label for="email_user">Email :</label>
                        <input type="text" name="email_user" id="email_user" <?= isset($dataUser['email_user']) ? "value=" . $dataUser['email_user'] : "" ?>>
                    </div>
                    <div class="form-group form" id="group">
                        <label for="password_user">Mot de passe :</label>
                        <input type="password" name="password_user" id="password_user" <?= isset($dataUser['password_user']) ? "value=" . $dataUser['password_user'] : "" ?>>
                    </div>
                    <div class="form-group form" id="group">
                        <label for="photo_user">Photo de profil :</label>
                        <input type="file" name="photo_user" id="photo_user">
                    </div>
                    <span class="error"><?= (isset($error) && $error) ? $error : "" ?></span>
                    <div class="button-content login">
                        <button class="btn save btn-small" type="submit">S'inscrire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once('views/includes/footer.php') ?>
</body>

</html>