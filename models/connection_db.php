<?php


class Connexion
{
    private const DNS = "mysql:host=localhost;dbname=blog_miashs";
    private const USER = "root";
    private const PASSWORD = "";
    private static $connect = null;
    function __contruct()
    {
    }
    static function connectDb()
    {
        if (is_null(self::$connect)) {
            try {
                self::$connect = new PDO(self::DNS, self::USER, self::PASSWORD, [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $err) {
                echo "La connexion à la base de donnée a échoué";
            }
        }
        return self::$connect;
    }
}
