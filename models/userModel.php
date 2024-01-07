<?php


function save_user(string $nom_user, string $email_user, string $password_user, string $photo_user)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();
    if (!is_null($pdo)) {

        $stmt = $pdo->prepare("INSERT INTO user VALUES(
            DEFAULT,
            :nom_user,
            :email_user,
            :password_user,
            :photo_user
        )");
        $stmt->bindValue(":nom_user", $nom_user);
        $stmt->bindValue(":email_user", $email_user);
        $stmt->bindValue(":password_user", $password_user);
        $stmt->bindValue(":photo_user", $photo_user);
        $stmt->execute();
    }
}

function getUserEmail(string $email_user)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();

    if (!is_null($pdo)) {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email_user=:email_user
        ');

        $stmt->bindValue("email_user", $email_user);
        $stmt->execute();
        return $stmt->fetchAll();
    };
}

function getUserId($id_user)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();

    if (!is_null($pdo)) {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE id_user=:id_user
        ');

        $stmt->bindValue("id_user", $id_user);
        $stmt->execute();
        return $stmt->fetchAll();
    };
}
