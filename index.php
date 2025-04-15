<?php
require_once(__DIR__ . '/middleware/SecurityMiddleware.php');

// Appliquer le middleware de sécurité
SecurityMiddleware::handle();

if (isset($_GET["page"])) {
    $page = $_GET["page"];
    if (file_exists("controllers/$page" . "controller.php")) {
        require_once("controllers/$page" . "controller.php");
    }else{
        require_once("controllers/homecontroller.php");
    }
}else{
    require_once("controllers/homecontroller.php");
}



