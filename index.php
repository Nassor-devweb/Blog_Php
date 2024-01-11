<?php
session_start([
    "save_path" => __DIR__ . "/session",
    "cookie_lifetime" => 60 * 60 * 24,
]);

$filename = $_SERVER["SCRIPT_FILENAME"];
$filename = str_replace("index.php", "", $filename);
$host = $_SERVER["SERVER_NAME"];
$UrlAccueil = "http://" . $host . "/blog_miashs/";



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
