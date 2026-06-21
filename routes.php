<?php 

use \Core\Router;


$router->get("/", "index.php");

$router->get("/clubs", "clubs/index.php");

// $router->get("/club", "clubs/show.php");

$router->get("/key-dates", "dates/index.php");

$router->get("/contact", "contact.php");
