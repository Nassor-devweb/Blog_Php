<?php

function save_coment_model($id_article, $id_user, $contenu_coment)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();
    $date_coment = Date(DateTime::ATOM, time());
    $stmt = $pdo->prepare("INSERT INTO coment VALUES(
        DEFAULT,
        :contenu_coment,
        :date_coment,
        :id_user_coment,
        :id_article_coment
    )");

    $stmt->bindValue('contenu_coment', $contenu_coment);
    $stmt->bindValue('date_coment', $date_coment);
    $stmt->bindValue('id_user_coment', $id_user);
    $stmt->bindValue('id_article_coment', $id_article);
    $stmt->execute();
}
