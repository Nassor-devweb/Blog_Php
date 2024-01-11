<?php

if (!isset($_SESSION['id_user'])) {
    header("Location:$UrlAccueil" . "userController/connexion");
}

$errors = [
    "length" => "Le tite doit contenir au moins trois caractères",
    "empty" => "Veuillez remplir tout les champs",
    "contentLength" => "Le contenue doit contenir plus de 20 caractères",
    "imgEmpty" => "Veuillez inserer une image !!",
    "fileExtension" => "Veuillez inserer un fichier avec une extension valide !!"
];

function save_article_control()
{
    global $errors;
    global $filename;
    global $UrlAccueil;

    require_once("models/userModel.php");
    $user = getUserId($_SESSION['id_user']);

    if (isset($_POST["title"])) {

        $dataArticle = filter_input_array(INPUT_POST, [
            "title" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            "category" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            "content" => FILTER_SANITIZE_SPECIAL_CHARS
        ]);

        $titre = $dataArticle["title"];
        $contenue = $dataArticle['content'];
        $error = match (true) {
            (empty(trim($titre)) || empty(trim($contenue)) == true) => $errors["empty"],
            (mb_strlen(trim($titre)) < 3) => $errors["empty"],
            (mb_strlen(trim($contenue)) < 20) => $errors['contentLength'],
            default => ''
        };

        $dataArticle["file"] = '';
        if ($_FILES["file"] && $_FILES['file']['name']) {
            $pathInfo = pathinfo($_FILES["file"]["name"]);
            $filesExtension = $pathInfo["extension"];
            $filesBasename = $pathInfo["basename"];
            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
            if (in_array($filesExtension, $allowedExtensions)) {
                $host = $_SERVER["SERVER_NAME"];
                $pathFile = "assets/images/" . time() . "_" . $filesBasename;
                move_uploaded_file($_FILES["file"]["tmp_name"], $filename . $pathFile);
                $imgUrl = "http://" . $host . "/blog_miashs/" . $pathFile;
                $dataArticle["file"] = $imgUrl;
            } else {
                $error = $errors['fileExtension'];
            };
            if (!$error) {
                require_once("models/articleModels.php");
                save_article_db($dataArticle["title"], $dataArticle["category"], $dataArticle["content"], $dataArticle["file"], 1);
                header("Location:$UrlAccueil");
            } else {
                require_once("views/form.php");
            }
        } else {
            $error = $errors['imgEmpty'];
            require_once("views/form.php");
        }
    }
}

function getAllArticle()
{
    require_once("models/userModel.php");
    $user = getUserId($_SESSION['id_user']);
    $_SESSION['categorie'] = "toute";

    require_once("models/articleModels.php");
    $allArticle = getAllArticle_db();
    //-------------Nombre d'article par catégorie--------------
    $reduceNbPerCategory = array_reduce($allArticle, function ($acc, $curr) {
        if (isset($acc[$curr["categorie_article"]])) {
            $acc[$curr["categorie_article"]] += 1;
        } else {
            $acc[$curr["categorie_article"]] = 1;
        }
        return $acc;
    }, []);
    //------------------Article par categorie-------------------

    $reduceArticlePerCategory = array_reduce($allArticle, function ($acc, $curr) {
        if (isset($acc[$curr["categorie_article"]])) {
            $acc[$curr["categorie_article"]] = [$curr, ...$acc[$curr["categorie_article"]]];
        } else {
            $acc[$curr["categorie_article"]] = [$curr];
        }
        return $acc;
    }, []);

    require_once("views/accueil.php");
}

function getAllArticleCat($categorie)
{
    $_SESSION['categorie'] = $categorie;
    require_once("models/userModel.php");
    $user = getUserId($_SESSION['id_user']);

    require_once("models/articleModels.php");
    $allArticle = getAllArticle_db();

    //-------------Nombre d'article par catégorie--------------
    $reduceNbPerCategory = array_reduce($allArticle, function ($acc, $curr) {
        if (isset($acc[$curr["categorie_article"]])) {
            $acc[$curr["categorie_article"]] += 1;
        } else {
            $acc[$curr["categorie_article"]] = 1;
        }
        return $acc;
    }, []);
    //------------------Article par categorie-------------------

    $reduceArticlePerCategory = array_reduce($allArticle, function ($acc, $curr) {
        if (isset($acc[$curr["categorie_article"]])) {
            $acc[$curr["categorie_article"]] = [$curr, ...$acc[$curr["categorie_article"]]];
        } else {
            $acc[$curr["categorie_article"]] = [$curr];
        }
        return $acc;
    }, []);

    require_once("views/accueil.php");
}

function updateArticle($idArticle)
{
    require_once("models/userModel.php");
    $user = getUserId($_SESSION['id_user']);

    require_once("models/articleModels.php");
    $dataArticle = getOneArticle_db($idArticle);
    global $errors;
    global $filename;
    global $UrlAccueil;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $data = filter_input_array(INPUT_POST, [
            'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'category' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'content' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ]);

        $error = match (true) {
            (empty(trim($data['title'])) == true) => $errors['empty'],
            (mb_strlen(trim($data['title'])) < 3) => $errors['length'],
            (mb_strlen(trim($data['content'])) < 20) => $errors['contentLength'],
            default => ''
        };

        if (isset($_FILES['file']) && $_FILES['file']['name']) {

            //---------Donnée nécessaire pour la suppression de l'ancien fichier

            $currentImgLink = $dataArticle[0]['image_article'];
            $pathReplace = str_replace("http://localhost/dyma_php_blog/", "", $currentImgLink);
            $currenImgPath = $filename . $pathReplace;

            //---------Vérification extension + suppression de l'ancien fichier

            $extensionAllowed = ['jpg', 'png', 'jpeg', 'gif'];
            $fileInfo = pathinfo($_FILES['file']['name']);
            $fileBasename = $fileInfo['basename'];
            $fileExtension = $fileInfo['extension'];
            if (in_array($fileExtension, $extensionAllowed)) {

                if (file_exists($currenImgPath)) {
                    unlink($currenImgPath);
                }
                $linkFile = 'assets/images/' . time() . '_' . $fileBasename;
                $fullPathFile = $filename . $linkFile;
                move_uploaded_file($_FILES['file']['tmp_name'], $fullPathFile);
                $fullLinkFile = "http://" . $_SERVER['HTTP_HOST'] . "/dyma_php_blog/" . $linkFile;
                $data['file'] = $fullLinkFile;
            } else {
                $error = $errors['fileExtension'];
            }
            if (!$error) {
                updateArticle_db($idArticle, $data['title'], $data['category'], $data['content'], $data['file']);
                header("Location:$UrlAccueil");
            } else {
                require_once('views/form.php');
            }
        } else {
            $error = $errors['imgEmpty'];
            require_once('views/form.php');
        }
    }
}

function dislikeArticle($idArticle)
{
    require_once("models/articleModels.php");
    dislikeArticle_db($idArticle, $_SESSION['id_user']);
    getAllArticle();
}

function likeArticle($idArticle)
{
    require_once("models/articleModels.php");
    likeArticle_db($idArticle, $_SESSION['id_user']);
    getAllArticle();
}

function getOneArticle($id_article)
{
    require_once("models/userModel.php");
    $user = getUserId($_SESSION['id_user']);

    require_once("models/articleModels.php");
    $article = getOneArticle_db($id_article);
    $allComent = getAllComent($id_article);
    //echo "<pre>";
    //print_r($allComent);
    //echo "</pre>";
    require_once("views/onepagearticle.php");
}

function deleteArticle($idArticleDelete)
{
    require_once("models/userModel.php");
    $user = getUserId($_SESSION['id_user']);
    $categorie = $_SESSION['categorie'];

    require_once("models/articleModels.php");
    $allArticle = getAllArticle_db();
    //-------------Nombre d'article par catégorie--------------
    $reduceNbPerCategory = array_reduce($allArticle, function ($acc, $curr) {
        if (isset($acc[$curr["categorie_article"]])) {
            $acc[$curr["categorie_article"]] += 1;
        } else {
            $acc[$curr["categorie_article"]] = 1;
        }
        return $acc;
    }, []);
    //------------------Article par categorie-------------------

    $reduceArticlePerCategory = array_reduce($allArticle, function ($acc, $curr) {
        if (isset($acc[$curr["categorie_article"]])) {
            $acc[$curr["categorie_article"]] = [$curr, ...$acc[$curr["categorie_article"]]];
        } else {
            $acc[$curr["categorie_article"]] = [$curr];
        }
        return $acc;
    }, []);
    require_once("views/accueil.php");
}

function deleteArticleConfirm($idArticleConfirm)
{
    require_once('models/articleModels.php');
    deleteArticleModel($idArticleConfirm);
    $categorie = $_SESSION['categorie'];
    require_once("models/userModel.php");
    $user = getUserId($_SESSION['id_user']);

    $allArticle = getAllArticle_db();
    //-------------Nombre d'article par catégorie--------------
    $reduceNbPerCategory = array_reduce($allArticle, function ($acc, $curr) {
        if (isset($acc[$curr["categorie_article"]])) {
            $acc[$curr["categorie_article"]] += 1;
        } else {
            $acc[$curr["categorie_article"]] = 1;
        }
        return $acc;
    }, []);
    //------------------Article par categorie-------------------

    $reduceArticlePerCategory = array_reduce($allArticle, function ($acc, $curr) {
        if (isset($acc[$curr["categorie_article"]])) {
            $acc[$curr["categorie_article"]] = [$curr, ...$acc[$curr["categorie_article"]]];
        } else {
            $acc[$curr["categorie_article"]] = [$curr];
        }
        return $acc;
    }, []);
    require_once("views/accueil.php");
}
