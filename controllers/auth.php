<?php

function deconnexion()
{
    global $UrlAccueil;
    session_unset();
    session_destroy();
    header("Location:$UrlAccueil" . "userController/connexion");
}
