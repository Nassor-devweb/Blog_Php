<?php
$errors = [
    "length" => "Le tite doit contenir au moins trois caractères",
    "empty" => "Veuillez remplir tout les champs",
    "contentLength" => "Le contenue doit contenir plus de 20 caractères"
];

function save_article_control()
{
    global $errors;
    global $filename;
    if (isset($_POST["title"])) {
        $titre = $_POST["title"];
        $contenue = $_POST['content'];
        $error = match (true) {
            (empty(trim($titre)) || empty(trim($contenue)) == true) => $errors["empty"],
            (mb_strlen(trim($titre)) < 3) => $errors["empty"],
            (mb_strlen(trim($contenue)) < 20) => $errors['contentLength'],
            default => ''
        };
        if (!$error) {
            $dataArticle = filter_input_array(INPUT_POST, [
                "title" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                "category" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                "content" => FILTER_SANITIZE_SPECIAL_CHARS
            ]);
            $dataArticle["file"] = '';
            if (isset($_FILES["file"]) && !$_FILES["file"]["error"]) {
                $pathInfo = pathinfo($_FILES["file"]["name"]);
                $filesExtension = $pathInfo["extension"];
                $filesBasename = $pathInfo["basename"];
                $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                if (in_array($filesExtension, $allowedExtensions)) {
                    $host = $_SERVER["SERVER_NAME"];
                    $pathFile = "assets/images/" . time() . "_" . $filesBasename;
                    move_uploaded_file($_FILES["file"]["tmp_name"], $filename . $pathFile);
                    $imgUrl = "http://" . $host . "/dyma_php_blog/" . $pathFile;
                    $dataArticle["file"] = $imgUrl;
                };
            }
            require_once("models/articleModels.php");
            save_article_db($dataArticle["title"], $dataArticle["category"], $dataArticle["content"], $dataArticle["file"], 1);
        } else {
            require_once("views/form.php");
        }
    } else {
        require_once("views/form.php");
    }
}

function getAllArticle()
{
    require_once("models/articleModels.php");
    $allArticle = getAllArticle_db("toute");
    require_once("views/accueil.php");
}

function dislikeArticle($idArticle)
{

    require_once("models/articleModels.php");
    dislikeArticle_db($idArticle, 1);
    getAllArticle();
}

function likeArticle($idArticle)
{
    require_once("models/articleModels.php");
    likeArticle_db($idArticle, 1);
    getAllArticle();
}

function getOneArticle($id_article)
{
    require_once("models/articleModels.php");
    $article = getOneArticle_db($id_article);
    $allComent = getAllComent($id_article);
    //echo "<pre>";
    //print_r($article);
    //print_r($allComent);
    //echo "</pre>";
    require_once("views/onepagearticle.php");
}
