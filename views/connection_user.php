<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="/blog_miashs/">
    <?php include_once('views/includes/head.php') ?>
</head>

<body>
    <div class="container">
        <?php require_once('views/includes/header.php') ?>
        <div class="content">
            <div class="block">
                <h1>Connectez-vous</h1>
                <form action="userController/connexion" method="POST" enctype="multipart/form-data">
                    <div class="form-group form">
                        <label for="email_user">Email :</label>
                        <input type="email" name="email_user" id="email_user" <?= isset($dataUser['email_user']) ? "value=" . $dataUser['email_user'] : "" ?>>
                    </div>
                    <div class="form-group form" id="group">
                        <label for="password_user">Mot de passe :</label>
                        <input type="password" name="password_user" id="password_user">
                    </div>
                    <span class="error"><?= (isset($error) && $error) ? $error : "" ?></span>
                    <div class="button-content login">
                        <button class="btn save btn-small" type="submit">Connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once('views/includes/footer.php') ?>
</body>

</html>