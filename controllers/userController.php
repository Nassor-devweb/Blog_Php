<?php

$errorsUser = [
    "length" => [
        "nom_user" => "Le pseudo doit contenir au moins deux caractères !!",
        "password" => "Le mots de passe doit contenir au moins 6 et au plus 16 caractères !!",
    ],
    "empty" => "Veuillez remplir tous les champs !!",
    "fileExtension" => "Veuillez inserer un fichier avec une extension valide !!",
    "email" => "L'email est incorrect !!",
    "auth" => "Désolé, nous n'avons pas pu vous identifier, vérifiez vos identifiants !!"
];


function inscription()
{
    //Si la rêquete est de type POST alors on enregistre l'utilisateur en base de donnée sinon il s'agit d'une rêquete GET on renvoie la vue inscription

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        global $errorsUser;
        global $filename;
        global $UrlAccueil;

        $dataUser = filter_input_array(INPUT_POST, [
            "nom_user" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            "email_user" => FILTER_SANITIZE_EMAIL,
        ]);
        $dataUser['password_user'] = $_POST['password_user'];
        $error = match (true) {
            (empty(trim($dataUser['nom_user'])) || empty(trim($dataUser['email_user'])) || empty(trim($dataUser['password_user']))) == true  => $errorsUser["empty"],
            (mb_strlen($dataUser['nom_user']) < 2) => $errorsUser["length"]['nom_user'],
            (mb_strlen($dataUser['password_user']) < 6 || mb_strlen($dataUser['password_user']) > 16) => $errorsUser["length"]['password'],
            filter_var($dataUser['email_user'], FILTER_VALIDATE_EMAIL) == false => $errorsUser["email"],
            default => ''
        };

        // Si la rêquete contient un fichier

        if (isset($_FILES['photo_user']) && $_FILES['photo_user']['error'] == 0) {
            $extensionAllowed = ["jpg", "png", "jpeg"];
            $fileInfo = pathinfo($_FILES['photo_user']['name']);
            $photoUserExtension = $fileInfo['extension'];
            $filesBasename = $fileInfo['basename'];

            if (in_array($photoUserExtension, $extensionAllowed)) {
                $host = $_SERVER["SERVER_NAME"];
                $pathFile = "assets/images/avatars/" . time() . "_" . $filesBasename;
                move_uploaded_file($_FILES["photo_user"]["tmp_name"], $filename . $pathFile);
                $imgUrl = "http://" . $host . "/dyma_php_blog/" . $pathFile;
                $dataUser["photo_user"] = $imgUrl;
            } else {
                $error = $errorsUser['fileExtension'];
            }
        }

        // S'il n'y a pas d'erreur liée à la saisie utilisateur 

        if (!$error) {
            // Cryptage du mot de passe
            $dataUser['password_user'] = password_hash($dataUser['password_user'], PASSWORD_ARGON2ID);

            //Après vérification des données Enregistrement de l'utilisateur en base de donnée

            require_once("models/userModel.php");
            save_user($dataUser['nom_user'], $dataUser['email_user'], $dataUser['password_user'], $dataUser['photo_user']);

            //Après inscription on redirige l'utilisateur vers la page connection 
            header("Location:$UrlAccueil" . "userController/connection");
        } else {
            require_once('views/inscription_user.php');
        }
    } else {
        require_once('views/inscription_user.php');
    }
}

function getUser()
{
    require_once("models/userModel.php");
    $user = getUserId($_SESSION['id_user']);
    return $user;
}

// La fonction connection va traîter la connection de l'utilisateur
function connexion()
{
    global $UrlAccueil;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        global $errorsUser;
        require("models/userModel.php");

        $dataUser = filter_input_array(INPUT_POST, [
            "email_user" => FILTER_SANITIZE_EMAIL,
        ]);
        $dataUser['password_user'] = $_POST['password_user'];

        $error = match (true) {
            (empty(trim($dataUser['email_user'])) || empty(trim($dataUser['password_user']))) == true  => $errorsUser["empty"],
            filter_var($dataUser['email_user'], FILTER_VALIDATE_EMAIL) == false => $errorsUser['email'],
            default => ''
        };

        if (!$error) {
            $user = getUserEmail($dataUser["email_user"]);

            if (isset($user[0]["email_user"])) {
                if (password_verify($dataUser['password_user'], $user[0]["password_user"])) {
                    $_SESSION['id_user'] = $user[0]["id_user"];
                    header("Location:$UrlAccueil");
                } else {
                    $error = $errorsUser['auth'];
                    require_once("views/connection_user.php");
                }
            } else {
                $error = $errorsUser['auth'];
                require_once("views/connection_user.php");
            }
        } else {
            require_once("views/connection_user.php");
        }
    } else {
        require_once('views/connection_user.php');
    }
}
