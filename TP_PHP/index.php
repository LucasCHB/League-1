<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <header>
        <table border="0" class="header_title">
            <tr>
                <td>Site Ligue 1</td>
            </tr>
        </table>
        <table border="0" class="header_link">
            <tr>
                <td><a href="/">Accueil</a></td>
                <td><a href="/clubs">Clubs</a></td>
                <td><a href="/inscription">Inscription</a></td>
            </tr>
        </table>
    </header>
    <body>
        <h1>Je vous souhaite une chaleureuse bienvenue sur mon site exceptionnellement complet :P</h1>
    </body>
</html>

<?php
    include('Router.php');

    $router = new Router();

    $router->addRoute("/", "index.php");
    $router->addRoute("/clubs", "controller/c_club.php");
    $router->addRoute("/inscription", "controller/c_inscription.php");

    $_SERVER["REQUEST_URI"];

    $router->execute($_SERVER["REQUEST_URI"]);
?>