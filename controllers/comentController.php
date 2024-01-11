<?php

function save_coment($id_article, $id_user)
{
    global $UrlAccueil;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once("models/comentModel.php");

        $contentIsEmpty = "Le champs commentaire est vide veuillez remplir le champs";

        $contenu_coment = filter_input_array(INPUT_POST, [
            "contenu_coment" => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ]);
        $error = match (true) {
            (empty(trim($contenu_coment['contenu_coment'])) == true) => $contentIsEmpty,
            default  => null
        };
        if (is_null($error)) {
            save_coment_model($id_article, $id_user, $contenu_coment['contenu_coment']);
            header("Location:$UrlAccueil" . "articleControllers/getOneArticle/$id_article" . "#formContent");
        } else {
            require_once("models/userModel.php");
            $user = getUserId($_SESSION['id_user']);

            require_once("models/articleModels.php");
            $article = getOneArticle_db($id_article);
            $allComent = getAllComent($id_article);
            require_once("views/onepagearticle.php");
        }
    }
}
