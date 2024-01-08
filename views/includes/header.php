<header id="deleteConfirm">
    <div class="logo">Nas blog</div>
    <div class="content-menu">
        <?php if (isset($_SESSION['id_user'])) : ?>
            <img src=<?= isset($user[0]['photo_user']) ? $user[0]['photo_user'] : "" ?> alt="">
            <i class="fa-solid fa-sort-down"></i>
            <ul class="content-menu__liste">
                <li><i class="fa-regular fa-user"></i>Mon compte</li>
                <li><a href="formControle/getform"><i class="fa-regular fa-file-lines"></i>Ajouter un article</a></li>
                <li><a href="auth/deconnexion"><i class="fa-solid fa-power-off"></i>Déconnexion</a></li>
            </ul>
        <?php else : ?>
            <ul class="connectListe">
                <li><a href="userController/inscription">Inscription</a></li>
                <li><a href="userController/connexion">Connection</a></li>
            </ul>
        <?php endif; ?>
    </div>
</header>