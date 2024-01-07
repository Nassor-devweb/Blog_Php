<?php

if (!isset($_SESSION['id_user'])) {
    header("Location:$UrlAccueil" . "userController/connexion");
}

function getform()
{
    require_once("models/userModel.php");
    $user = getUserId($_SESSION['id_user']);

    require_once("views/form.php");
}

function updateArticle($idArticle)
{
    require_once("models/userModel.php");
    $user = getUserId($_SESSION['id_user']);

    require("models/articleModels.php");
    $dataArticle = getOneArticle_db($idArticle);
    $udapteArticle = true;
    require_once("views/form.php");
}
