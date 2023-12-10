<?php

function getform()
{
    require_once("views/form.php");
}

function updateArticle($idArticle)
{
    require("models/articleModels.php");
    $dataArticle = getOneArticle_db($idArticle);
    $udapteArticle = true;
    require_once("views/form.php");
}
