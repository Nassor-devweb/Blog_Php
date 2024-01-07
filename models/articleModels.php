<?php

function save_article_db(string $titre_article, string $categorie_article, string $contenu_article, string $image_article, int $id_user)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();
    if (!is_null($pdo)) {
        $date_article = Date(DateTime::ATOM, time());
        $stmt = $pdo->prepare("INSERT INTO article VALUES(
            DEFAULT,
            :titre_article,
            :categorie_article,
            :contenu_article,
            :image_article,
            :date_article,
            :id_user  
        )");
        $stmt->bindValue(":titre_article", $titre_article);
        $stmt->bindValue(":categorie_article", $categorie_article);
        $stmt->bindValue(":contenu_article", $contenu_article);
        $stmt->bindValue(":image_article", $image_article);
        $stmt->bindValue(":date_article", $date_article);
        $stmt->bindValue(":id_user", $id_user);
        $stmt->execute();
    }
}
function getAllLike($id_article)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();
    $stmt = $pdo->prepare("SELECT * FROM likeArticle WHERE id_article_like = :id_article_like");
    $stmt->bindValue(":id_article_like", $id_article);
    $stmt->execute();
    return $stmt->fetchAll();
}
function getAllComent($id_article)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();
    $stmt = $pdo->prepare("SELECT * FROM coment WHERE id_article_coment = :id_article_coment");
    $stmt->bindValue(":id_article_coment", $id_article);
    $stmt->execute();
    return $stmt->fetchAll();
}

function  getAllArticle_db()
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();
    $stmt = $pdo->prepare("SELECT * FROM article INNER JOIN user ON user.id_user = article.id_user ORDER BY date_article ASC");
    //$stmt->bindValue(":orderBy", $orderBy);
    $stmt->execute();
    $data = $stmt->fetchAll();
    foreach ($data as $key => $article) {
        $nb_like = getAllLike($article["id_article"]);
        $nb_coment = getAllComent($article["id_article"]);
        $data[$key]["nb_like"] = count($nb_like) ?? 0;
        $data[$key]["nb_coment"] = count($nb_coment) ?? 0;
        $isLike = getAllLike($article["id_article"]);
        $data[$key]["is_like"] = in_array(1, array_column($isLike, "id_user_like")) ? true : false;
    }
    return  $data;
}

function updateArticle_db($idArtile, $titre_article, $categorie_article, $contenu_article, $image_article)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();
    $stmt = $pdo->prepare("UPDATE article SET 
        titre_article = :titre_article,
        categorie_article = :categorie_article,
        contenu_article = :contenu_article,
        image_article = :image_article  WHERE id_article = :id_article");
    $stmt->bindValue(":titre_article", $titre_article);
    $stmt->bindValue(":categorie_article", $categorie_article);
    $stmt->bindValue(":contenu_article", $contenu_article);
    $stmt->bindValue(":image_article", $image_article);
    $stmt->bindValue(":id_article", $idArtile);
    $stmt->execute();
}

function dislikeArticle_db($idArticle, $idUser)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();
    $stmt = $pdo->prepare("DELETE FROM likeArticle WHERE id_article_like = :id_article_like AND id_user_like = :id_user_like");
    $stmt->bindValue(":id_article_like", $idArticle);
    $stmt->bindValue(":id_user_like", $idUser);
    $stmt->execute();
}

function likeArticle_db($idArticle, $idUser)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();
    $stmt = $pdo->prepare("INSERT INTO likeArticle VALUES(
        DEFAULT,
        :id_user_like,
        :id_article_like
    )");
    $stmt->bindValue(":id_user_like", $idUser);
    $stmt->bindValue(":id_article_like", $idArticle);
    $stmt->execute();
}

function getOneArticle_db($id_article)
{
    require_once("models/connection_db.php");
    $pdo = Connexion::connectDb();
    $stmt = $pdo->prepare('SELECT * FROM article INNER JOIN user ON article.id_user = user.id_user where id_article = :id_article');
    $stmt->bindValue(":id_article", $id_article);
    $stmt->execute();
    return $stmt->fetchAll();
}
