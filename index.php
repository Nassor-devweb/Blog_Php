<?php

$filename = $_SERVER["SCRIPT_FILENAME"];
$filename = str_replace("index.php", "", $filename);
$host = $_SERVER["SERVER_NAME"];
$UrlAccueil = "http://" . $host . "/dyma_php_blog/";



if (isset($_GET["action"]) && $_GET["action"]) {
    $params = $_GET["action"];
    $params = explode("/", $params);
    $controller = $params[0];
    $action = $params[1];
    require_once($filename . "controllers/" . $controller . ".php");

    if (isset($params[2]) && isset($params[3])) {
        $action($params[2], $params[3]);
    } elseif (isset($params[2])) {
        $action($params[2]);
    } else {
        $action();
    }
} else {
    require_once("controllers/articleControllers.php");
    getAllArticle('toute');
}
http://localhost/dyma_php_blog/assets/images/1698946117_nas.jpg